<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Inventory;
use App\Models\Office;
use App\Models\ReferensiNamaProject;
use App\Models\RND;
use App\Models\WhoSubmitted;
use App\Models\Workshop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Who Submitted
        WhoSubmitted::create([
            'name' => 'Business Development'
        ]);
        WhoSubmitted::create([
            'name' => 'Finance'
        ]);
        WhoSubmitted::create([
            'name' => 'GA'
        ]);
        WhoSubmitted::create([
            'name' => 'Human Resource'
        ]);
        WhoSubmitted::create([
            'name' => 'Legal'
        ]);
        WhoSubmitted::create([
            'name' => 'Programmer'
        ]);
        WhoSubmitted::create([
            'name' => 'Project'
        ]);
        WhoSubmitted::create([
            'name' => 'Product'
        ]);
        WhoSubmitted::create([
            'name' => 'Production'
        ]);
        WhoSubmitted::create([
            'name' => 'Purchasing'
        ]);
        WhoSubmitted::create([
            'name' => 'R&D'
        ]);
        WhoSubmitted::create([
            'name' => 'Support Workshop'
        ]);
        WhoSubmitted::create([
            'name' => 'Tax'
        ]);
        // End Who Submitted


        // Start Referensi Project
//         BUZZ_BIN 2017
// JAMMER_BIN 2017
// STERIL_BIN 2017
// INUS MEDIA_BIN 2017
// INUS PERALATAN_BIN 2017
// EKON_BIN 2017
// CYBERNETWORK_BIN 2018
// BUZZERBINDA_BIN 2018
// JAKTIS_BIN 2018
// OPSIN_BIN 2018
// SURVEILLANCE_BIN 2018
// PENGMBANGANEKON_BIN 2018
// EMP_BIN 2019
// CIPKON_BIK 2019
// ADHOC_KJA 2019
// CCSOPS_MABES POLRI 2019
// IMM_BIK 2020
// IPA_BIK 2020
// SOSIALMEDIA_BRIMOB 2020
// IMM_AL 2020
// FPD_KEMHAN 2020
// X-RAY_KEMHAN 2020
// DESI_BIN 2020
// ADMIRALTY_BIK 2021
// ISA_KJA 2021
// RADAR_ POLAIR 2021
// LETTO-8_LEMDIKPOL 2021
// SIGINT SITE A_ BIN 2021
// SIGINT SITE B_ BIN 2021
// SIGINT SITE C_ BIN 2021
// SIGINT SITE D_ BIN 2021
// API_ BIN 2021
// CYBERMETRIC_BIN 2021
// STELLARSIBER_BIN 2021
// Jammer XL-100_BIN 2021
// NextG Jateng Jatim_BIK 2022
// NextG Kalteng Kalsel_BIK 2022
// NextG Sumut Lampung_BIK 2022
// PDN_BIK 2022
// SUCADNBO105_POLUD 2022
// IMA_BRIMOB 2022
// JIBOMPUSAT_BRIMOB 2022
// JIBOMDAERAH_BRIMOB 2022
// SIPL_LEMDIK 2022
// LETTO-8_LEMDIKPOL 2022
// VR_LEMDIK 2022
// RADAR_ POLAIR 2022
// CYBERTROOPS_KJA 2022
// VVIP_KJA 2022
// OSINT _ KJA 2022
// SIPL_KJA 2022
// CADABRA_KJA 2022
// PUSINFORMAR_MABES TNI 2022
// STELLAR_ DIVTIK 2022
// CYBERINT_DIVTIK 2022
// AKUSTEK_PDN DENSUS 2022
// DRONE_PDN DENSUS 2022
// AKUSTEK_KE BAINTELKAM 2022
// ALKES _ SUYOTO 2022
// SKYARMY _ BRIMOB 2023
// BACKTRACKING _ BRIMOB 2023
// PROELIUM SOLDIER _ BIN 2023
// SMAA_BIN 2023
// PRIVATE MESSANGER _ BIN 2023
// PDN_BIK 2023
// NEXTG SULUT GORONTALO_BIK 2023
// NEXTG SUMBAR RIAU_BIK 2023
// NEXTG JAMBI SUMSEL_BIK 2023
// NEXTG SUMSEL_BIK 2023
// NEXTG PAPUA_BIK 2023
// NEXTG KALTIM KALTARA_BIK 2023
// NEXTG MALUKU_BIK 2023
// NEXTG MALUT_BIK 2023
// ON BOARD _ POLAIR 2023
// VVIP MAKO _ POLUD 2023
// DAUPHIN AS365N3 _ POLUD 2023
// ENSTROM 480B _ POLUD 2023
// BELL B412 _ POLUD 2023
// DIGITAL FORENSIC_KJA 2023
// SMARTCLASS_KJA 2022
// SMARTCLASS_LEMDIK PDN 2023
// BIGDATA_DIVTIK PLN 2023
// RADAR_POLAIR 2023
// GAKKUM_POLAIR 2023
// OFFICE - ADMIN
// OPTISR_BIK 2023
// KOARMADA2_TNI AL 2023
// SAVINEPROFILING_DIVTIK 2022
// MASSIVE PROFILLING_KJA 2023
// SKYARMY _ DIVTIK 2023
        ReferensiNamaProject::create([
            'name' => 'BUZZ_BIN 2017'
        ]);
        ReferensiNamaProject::create([
            'name' => 'JAMMER_BIN 2017'
        ]);
        ReferensiNamaProject::create([
            'name' => 'STERIL_BIN 2017'
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);
        ReferensiNamaProject::create([
            'name' => ''
        ]);




        //End Referensi Project

        // Start Department

        Department::create([
            'name' => 'Business Development'
        ]);
        Department::create([
            'name' => 'Finance'
        ]);
        Department::create([
            'name' => 'GA'
        ]);
        Department::create([
            'name' => 'Human Resource'
        ]);
        Department::create([
            'name' => 'Legal'
        ]);
        Department::create([
            'name' => 'Programmer'
        ]);
        Department::create([
            'name' => 'Project'
        ]);
        Department::create([
            'name' => 'Product'
        ]);
        Department::create([
            'name' => 'Production'
        ]);
        Department::create([
            'name' => 'Purchasing'
        ]);
        Department::create([
            'name' => 'R&D'
        ]);
        Department::create([
            'name' => 'Support Workshop'
        ]);
        Department::create([
            'name' => 'Tax'
        ]);

        //End

        //Office
        Office::create([
            'name' => 'Test Office'
        ]);
        //End

        //Workshop
        Workshop::create([
            'name' => 'Test Workshop'
        ]);
        //End

        //Inventory
        Inventory::create([
            'name' => 'Test Inventory'
        ]);
        //End

        //R&D
        RND::create([
            'name' => 'Test RND'
        ]);
        //End

    }
}
//Business Development
// Finance
// GA
// Human Resource
// Legal
// Programmer
// Project
// Product
// Production
// Purchasing
// R&D
// Support Workshop
// Tax
