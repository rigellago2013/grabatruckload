<?php

namespace App\Models;

use App\Builders\OfferBuilder;
use App\Collections\OfferCollection;
use App\States\Offer\OfferState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\Pure;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Offer
 *
 * @property-read \App\Models\Load $offerLoad
 * @property-read \App\Models\Team $team
 * @method static Builder|Offer newModelQuery()
 * @method static Builder|Offer newQuery()
 * @method static Builder|Offer query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $state
 * @property int $team_id The team making the offer
 * @property int $load_id The load the offer is being made on
 * @property string $currency_code
 * @property int $offer_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static OfferBuilder|Offer forLoad(\App\Models\Load $load)
 * @method static OfferBuilder|Offer whereCreatedAt($value)
 * @method static OfferBuilder|Offer whereCurrencyCode($value)
 * @method static OfferBuilder|Offer whereId($value)
 * @method static OfferBuilder|Offer whereLoadId($value)
 * @method static OfferBuilder|Offer whereNotState(string $column, $states)
 * @method static OfferBuilder|Offer whereOfferAmount($value)
 * @method static OfferBuilder|Offer whereState($value)
 * @method static OfferBuilder|Offer whereTeamId($value)
 * @method static OfferBuilder|Offer whereUpdatedAt($value)
 */
class Offer extends Model
{
    use HasFactory;
    use HasStates;

    protected $casts = [
        'state' => OfferState::class,
    ];

    #[Pure]
    /**
     * @param $query
     * @return OfferBuilder<Offer>
     */
    public function newEloquentBuilder($query): OfferBuilder
    {
        return new OfferBuilder($query);
    }

    public function newCollection(array $models = []): OfferCollection
    {
        return new OfferCollection($models);
    }

    // The load that the offer is being made on
    public function offerLoad(): BelongsTo
    {
        return $this->belongsTo(Load::class, 'load_id');
    }

    // The person making the offer
    public function offeror(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
