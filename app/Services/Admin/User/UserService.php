<?php

namespace App\Services\Admin\User;

use App\DataTransferObjects\UserDTO;
use App\Repositories\Admin\Profile\ProfileRepository;
use App\Repositories\Admin\User\UserRepository;
use App\Services\InterfaceService;
use App\Services\Service;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserService extends Service implements InterfaceService
{
    use FileUpload;
    private $userRepository, $profileRepository;

    /**
     * iniliazed from trait FileUpload.
     */
    protected function fileSettings()
    {
        $this->settings = [
            'attributes'  => ['jpeg', 'jpg', 'png'],
            'path'        => 'upload/profile/photo/',
            'softdelete'  => false
        ];
    }

    public function __construct(UserRepository $userRepository, ProfileRepository $profileRepository)
    {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
    }

    public function getUsers(array $payload): object
    {
        return $this->userRepository->all($payload);
    }

    public function store(UserDTO $dto): object
    {
        $data = collect($dto)->only(['name', 'email'])->toArray();

        if ($dto->password) {
            $data['password'] = bcrypt($dto->password);
        }

        $uploadPhoto = $dto->profile->photo
            ? tap($this->fileSettings(), fn() => null) && $this->uploadFile($dto->profile->photo)
            : null;

        try {
            DB::beginTransaction();

            $user = $this->userRepository->store($data);

            if ($dto->role) {
                $user->assignRole($dto->role);
            }

            $this->profileRepository->updateOrCreate(
                ['user_id' => $user->id],
                ['photo' => $uploadPhoto ?? "photo {$dto->name}"]
            );

            DB::commit();
            Cache::flush();

            return $this->userRepository->getUserWithProfile($user->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $e;
        }
    }


    public function update(UserDTO $dto): object
    {
        $user = $this->userRepository->show($dto->id);

        // Data yang boleh diupdate
        $updateData = array_filter([
            'name'     => $dto->name,
            'email'    => $dto->email,
            'password' => $dto->password ? bcrypt($dto->password) : null,
        ], fn($v) => !is_null($v));

        // Update user & reset verification jika email berubah
        $user->fill($updateData);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($dto->profile?->photo) {
            $this->fileSettings();

            optional($user->profile?->photo, fn($old) => $this->deleteFile($old));

            $photo = $this->uploadFile($dto->profile->photo);

            $this->profileRepository->updateOrCreate(
                ['user_id' => $user->id],
                ['photo' => $photo ?? 'photo-' . ($dto->name ?? $user->name)]
            );
        }

        $user->save();

        if ($dto->role) {
            $user->syncRoles($dto->role);
        }

        Cache::flush();

        return $this->userRepository->getUserWithProfile($dto->id);
    }

    /**
     * delete one data.
     */
    public function delete(string $id): bool
    {
        $data = $this->userRepository->show($id);
        $this->fileSettings();
        if ($data->profile && $this->isFileExists($data->profile->photo)) {
            $this->deleteFile($data->profile->photo);
        }
        Cache::flush();
        return $this->userRepository->delete($id);
    }

    /**
     * delete many data.
     */
    public function destroy(array $ids): array
    {
        foreach ($ids as $id) {
            $data = $this->userRepository->show($id);
            $this->fileSettings();
            if ($data->profile && $this->isFileExists($data->profile->photo)) {
                $this->deleteFile($data->profile->photo);
            }
            $data->delete($id);
        }
        Cache::flush();
        return $ids;
    }
}
