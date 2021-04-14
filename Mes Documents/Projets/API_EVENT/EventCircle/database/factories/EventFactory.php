<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Organisateur;
use App\Models\TypeEvent;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $i = random_int(1,3);
        $orga= Organisateur::all();
        $type = TypeEvent::find($i);
        return [
            'codeEvent' => Event::generateCode(),
            'title' => $this->faker->name(),
            'codeTypeEvent' => $type->codeTypeEvent,
            'dateDebut' => $this->faker->date(),
            'dateFin' => $this->faker->date(),
            'heureDebut' => $this->faker->time(),
            'heureFin' => $this->faker->time(),
            'description' => $this->faker->text(),
            'localisation' => $this->faker->city(),
            'urlPhotoEvenement' => "http://localhost:8000/api/display/paamZaka2000.jpg",
            'nomLieu' => $this->faker->city(),
            'adresseLieu' => $this->faker->address(),
            'ville' => $this->faker->city(),
            'pays' => $this->faker->country(),
            'codeOrganisateur' => ($i > 1)? $orga->first()->codeOrganisateur:$orga->last()->codeOrganisateur,

        ];
    }
}
