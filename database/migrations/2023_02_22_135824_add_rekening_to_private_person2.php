<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_pp', function (Blueprint $table) {
            $table->string('no_rekening');
            $table->enum('bank',['BCA(014)','Mandiri(008)','BNI(009)','BRI(002)', 'BTN(200)','Danamon(011)', 'Permata(013)', 'Maybank(016)','PaninBank(019)','Cimb Niaga(022)','UOB(023)'
            ,'OCBC NISP(028)','Artha Graha(037)','Bumi Arta(076)','HSBC Indonesia(087)','J Trust(095)','Mayapada (097)','India Indonesia(146)','Muamalat(147)'
            ,'Mestika(151)','Shinan(152)','Sinarmas(153)','Maspion(157)','Ganesha(161)','ICBC(164)','QNB(167)','Woori Saudara(212)','Mega(426)','Bukopin(441)'
            ,'BSI(451)','Hana Bank(484)','MNC(485)','Bank Raya Indonesia(494)','SBI(498)','Mega Syariah(506)','Index Selindo(555)','Mayora(553)'
            ,'IDN CCB(036)','DBS(046)','Perdania(047)','Mizuho CBK(048)','Capital(054)','BNP Paribas', 'ANZ(061)','Agris(945)','Maybank Syariah(947)','CTBC(949)'
            ,'Common Wealth(950)','BTPN(213)','Victoria Syariah(405)','BJB Syariah(425)','Krom Bank(459)','BJJ (472)','Bank Neo Commerce(490)'
            ,'BCA Digital(501)','National Nobu(503)','INA Perdana(513)','Panin Bank Syariah(517)','Prima Master(520)','KB Bukopin Syariah(521)','Sampoerna(523)','OK Bank(526)'
            ,'Amar Bank(531)','Sea Bank(535)','BCA Syariah(536)','Bank Jago(542)','BTPN Syariah(547)','Bank MAS(548)','Bank Fama(562)','Mandiri Taspen(564)','Victoria Internasional(566)'
            ,'Allo Bank(567)','Bank Jabar(110)','Bank DKI(111)','BPD DIY(112)','Bank Jateng(113)','Bank Jatim(114)','Bank Jambi(115)','Bank Aceh(116)','Bank Sumut(117)','Bank Nagari(118)'
            ,'Bank Riau Kepri(119)','Bank SumselBabel(120)','Bank Lampung(121)','Bank BPD Kalsel(122)','Bank Kalbar(123)','Bank Kaltim(124)','Bank Kalteng(125)'
            ,'Bank Sulsel(126)','Bank SulutGo(127)','Bank NTB(128)','Bank BPD Bali(129)','Bank BPD NTT(130)','Bank Maluku(131)','Bank Papua(132)','Bank Bengkulu(133)','Bank Sulteng(134)'
            ,'Bank Banten(137)','Citibank (031)','JP Morgan Chase(032)','Bank Of America(033)','MUFG (042)','Standard Chartered(050)','Deutsche Bank (067)','Bank Of China(069)'])
            ->nullable();
            $table->string('cabang_bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('private_person', function (Blueprint $table) {
            //
        });
    }
};
