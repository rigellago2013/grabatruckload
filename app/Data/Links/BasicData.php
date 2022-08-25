<?php

namespace App\Data\Links;

use App\Http\Livewire\Loads\CreateLoadComponent;
use App\Http\Requests\CreateLoadRequest;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Livewire\TemporaryUploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

final class BasicData extends DataTransferObject
{
    // the customers internal reference code if applicable
    public string|null $reference;

    // the load type - this list should be subject to change
    public string $loadType;

    // weight in kg
    public int $weight;

    // volume in cubic meters
    public float $volume;

    public int $noOfItems;

    public string $description;

    // photos of the load
    /** @var array<UploadedFile|TemporaryUploadedFile>|null */
    public array|null $images;

    // files/documents related to the load
    /** @var array<UploadedFile|TemporaryUploadedFile>|null */
    public array|null $files;

    //user id
    public User|null $user;

    // If user wants an insurance
    public bool|null $wantsInsurance;

    // value of goods
    public int|null $valueOfGoods;

    // tc of insurance
    public bool|null $tcInsurance;

    public static function fromRequest(CreateLoadRequest $request): self
    {
        return new self($request->validated());
    }

    public static function fromComponent(CreateLoadComponent $component): self
    {
        return new self($component->validate());
    }
}
