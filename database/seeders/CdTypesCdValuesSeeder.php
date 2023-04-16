<?php

namespace Database\Seeders;

use App\Models\CdType;
use App\Models\CdValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CdTypesCdValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // type 1 values
        $cdType1 = CdType::create([
            'internalKey' => 'Organization.Type',
            'displayName' => 'Organization Type',
            'description' => 'Organization General Classification',
            'internalShortCode' => 1,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);
        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Corporation',
            'displayName' => 'Corporation',
            'description' => 'an organization, usually a group of people or a company, authorized by the state to act as a single entity (legally a person) and recognized as such in law for certain purposes',
            'internalShortCode' => 1,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Government',
            'displayName' => 'Government',
            'description' => 'system or group of people governing an organized community, often a state',
            'internalShortCode' => 2,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);
        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'NGO',
            'displayName' => 'Non-governmental',
            'description' => 'non-profit and sometimes international organizations[5] independent of governments and international governmental organizations',
            'internalShortCode' => 3,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Political',
            'displayName' => 'Political',
            'description' => 'any organization that involves itself in the political process',
            'internalShortCode' => 4,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'International',
            'displayName' => 'International',
            'description' => 'an organization with an international membership, scope, or presence',
            'internalShortCode' => 5,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Armed_Forces',
            'displayName' => 'Armed_Forces',
            'description' => 'heavily-armed, highly-organised force primarily intended for warfare',
            'internalShortCode' => 6,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Charitable',
            'displayName' => 'Charitable',
            'description' => 'a non-profit organization whose primary objectives are philanthropy and social well-being',
            'internalShortCode' => 7,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);
        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Nonprofit',
            'displayName' => 'Nonprofit',
            'description' => 'dedicated to furthering a particular social cause or advocating for a shared point of view',
            'internalShortCode' => 8,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);
        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Partnership',
            'displayName' => 'Partnership',
            'description' => 'arrangement where parties, known as partners, agree to cooperate to advance their mutual interests',
            'internalShortCode' => 9,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Cooperative',
            'displayName' => 'Cooperative',
            'description' => 'an autonomous association of persons united voluntarily to meet their common economic, social, and cultural needs and aspirations through a jointly-owned and democratically-controlled enterprise',
            'internalShortCode' => 10,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);
        CdValue::create([
            'cdTypeUID' => $cdType1->id,
            'weight' => 0,
            'internalKey' => 'Educational',
            'displayName' => 'Educational',
            'description' => 'Educational Institution',
            'internalShortCode' => 11,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);


        //type 2 values

        $cdType2 = CdType::create([
            'internalKey' => 'Application.Type',
            'displayName' => 'Application Type',
            'description' => 'Application General Classification',
            'internalShortCode' => 2,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType2->id,
            'weight' => 0,
            'internalKey' => 'Hardware',
            'displayName' => 'Hardware',
            'description' => 'Hardware Based, such as Software Applicances',
            'internalShortCode' => 1,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType2->id,
            'weight' => 0,
            'internalKey' => 'System',
            'displayName' => 'System',
            'description' => 'System Software, such as Operating Systems',
            'internalShortCode' => 2,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType2->id,
            'weight' => 0,
            'internalKey' => 'Application',
            'displayName' => 'Application',
            'description' => 'Application Software, such as GUI Applications',
            'internalShortCode' => 3,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType2->id,
            'weight' => 0,
            'internalKey' => 'Interface',
            'displayName' => 'Interface',
            'description' => 'Interface Software, such as Interface Engines',
            'internalShortCode' => 4,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);
        // type 3 values

        $cdType3 = CdType::create([
            'internalKey' => 'Gender',
            'displayName' => 'Application Type',
            'description' => 'Application General Classification',
            'internalShortCode' => 3,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1,
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType3->id,
            'weight' => 0,
            'internalKey' => 'Male',
            'displayName' => 'Male',
            'description' => 'Male',
            'internalShortCode' => 1,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType3->id,
            'weight' => 0,
            'internalKey' => 'Female',
            'displayName' => 'Female',
            'description' => 'Female',
            'internalShortCode' => 2,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);

        CdValue::create([
            'cdTypeUID' => $cdType3->id,
            'weight' => 0,
            'internalKey' => 'Unknown',
            'displayName' => 'Unknown',
            'description' => 'Unknown',
            'internalShortCode' => 3,
            'rwStatusCd' => 1,
            'rwCreatedSessionID' => 1
        ]);
    }
}
