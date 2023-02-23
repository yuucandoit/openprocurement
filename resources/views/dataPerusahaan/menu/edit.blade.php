<title>Edit Vendor</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Edit</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-perusahaan/') }}">Company Data</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Edit Vendor</h5>
                            </div>
                            <div class="card-body">
                                <form class="row g-2" action={{ url('/menu-perusahaan/update/' . $dv->id) }} method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="fa fa-building-o"></i> Company
                                                Name</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="nama" value="{{ $dv->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="alamat" value="{{ $dv->alamat }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-telephone"></i> Office
                                                Contact</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="No Telpon" name="no_telp_kantor"
                                                value="{{ $dv->no_telp_kantor }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="floatingAddress"><i class="fa fa-link"></i> Website</label>
                                            <input type="text" class="form-control" id="floatingAddress"
                                                placeholder="alamat" name="website" value="{{ $dv->website }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-id-card"></i> PIC
                                                Name</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="nama_pic" value="{{ $dv->nama_pic }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-support"></i> Contact
                                                PIC</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="no_telp_pic"
                                                value="{{ $dv->no_telp_pic }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingKeterangan"><i class="icofont icofont-email"></i>
                                                Email</label>
                                            <input type="text" class="form-control" id="floatingKeterangan"
                                                placeholder="Email" name="email" value="{{ $dv->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-id-card"></i> Company
                                                NPWP</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="npwp_perusahaan"
                                                value="{{ $dv->npwp_perusahaan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingUnit"><i class="icofont icofont-paper"></i> -- PKP /
                                                NON-PKP --</label>
                                            <select class="form-select" id="floatingUnit" placeholder="pkp"
                                                name="Pkp" value="{{ $dv->Pkp }}">
                                                <option value="PKP">PKP</option>
                                                <option value="Non-PKP">Non-PKP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-id-card"></i> NIB</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="nib" value="{{ $dv->nib }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="fa fa-briefcase"></i> Business
                                                Fields</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="bidang_usaha"
                                                value={{ $dv->bidang_usaha }}>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="fa fa-credit-card"></i> Account
                                                Number</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="no_rekening"
                                                value="{{ $dv->no_rekening }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingUnit"><i class="fa fa-bank"></i> -- Bank --</label>
                                            <select class="form-select js-example-basic-single" id="floatingUnit" placeholder="Bank"
                                                name="bank">
                                                <option value="{{ $dv->bank }}" selected >{{ $dv->bank }}</option>
                                                <option value="BCA(014)">BCA(014)</option>
                                                <option value="Mandiri(008)">Mandiri(008)</option>
                                                <option value="BNI(009)">BNI(009)</option>
                                                <option value="BRI(002)">BRI(002)</option>
                                                <option value="BTN(200)">BTN(200)</option>
                                                <option value="Danamon(011)">Danamon(011)</option>
                                                <option value="Permata(013)">Permata(013)</option>
                                                <option value="Maybank(016)">Maybank(016)</option>
                                                <option value="PaninBank(019)">PaninBank(019)</option>
                                                <option value="Cimb Niaga(022)">Cimb Niaga(022)</option>
                                                <option value="UOB(023)">UOB(023)</option>
                                                <option value="OCBC NISP(028)’">OCBC NISP(028)’</option>
                                                <option value="Artha Graha(037)">Artha Graha(037)</option>
                                                <option value="Bumi Arta(076)">Bumi Arta(076)</option>
                                                <option value="HSBC Indonesia(087)’">HSBC Indonesia(087)’</option>
                                                <option value="J Trust(095)">J Trust(095)</option>
                                                <option value="Mayapada (097)">Mayapada (097)</option>
                                                <option value="India Indonesia(146)">India Indonesia(146)</option>
                                                <option value="Muamalat(147)">Muamalat(147)</option>
                                                <option value="Mestika(151)">Mestika(151)</option>
                                                <option value="Shinan(152)">Shinan(152)</option>
                                                <option value="Sinarmas(153)">Sinarmas(153)</option>
                                                <option value="Maspion(157)">Maspion(157)</option>
                                                <option value="Ganesha(161)">Ganesha(161)</option>
                                                <option value="ICBC(164)">ICBC(164)</option>
                                                <option value="QNB(167)">QNB(167)</option>
                                                <option value="Woori Saudara(212)">Woori Saudara(212)</option>
                                                <option value="Mega(426)">Mega(426)</option>
                                                <option value="Bukopin(441)">Bukopin(441)</option>
                                                <option value="BSI(451)">BSI(451)</option>
                                                <option value="Hana Bank(484)">Hana Bank(484)</option>
                                                <option value="MNC(485)">MNC(485)</option>
                                                <option value="Bank Raya Indonesia(494)">Bank Raya Indonesia(494)</option>
                                                <option value="SBI(498)">SBI(498)</option>
                                                <option value="'Mega Syariah(506)">'Mega Syariah(506)</option>
                                                <option value="Index Selindo(555)">Index Selindo(555)</option>
                                                <option value="Mayora(553)">Mayora(553)</option>
                                                <option value="IDN CCB(036)">IDN CCB(036)</option>
                                                <option value="DBS(046)">DBS(046)</option>
                                                <option value="Perdania(047)">Perdania(047)</option>
                                                <option value="Mizuho CBK(048)">Mizuho CBK(048)</option>
                                                <option value="Capital(054)">Capital(054)</option>
                                                <option value="BNP Paribas">BNP Paribas</option>
                                                <option value="ANZ(061)">ANZ(061)</option>
                                                <option value="Agris(945)">Agris(945)</option>
                                                <option value="Maybank Syariah(947)">Maybank Syariah(947)</option>
                                                <option value="CTBC(949)">CTBC(949)</option>
                                                <option value="Common Wealth(950)">Common Wealth(950)</option>
                                                <option value="BTPN(213)">BTPN(213)</option>
                                                <option value="Victoria Syariah(405)">Victoria Syariah(405)</option>
                                                <option value="BJB Syariah(425)">BJB Syariah(425)</option>
                                                <option value="Krom Bank(459)">Krom Bank(459)</option>
                                                <option value="BJJ (472)">BJJ (472)</option>
                                                <option value="Bank Neo Commerce(490)">Bank Neo Commerce(490)</option>
                                                <option value="BCA Digital(501)">BCA Digital(501)</option>
                                                <option value="National Nobu(503)">National Nobu(503)</option>
                                                <option value="INA Perdana(513)">INA Perdana(513)</option>
                                                <option value="Panin Bank Syariah(517)">Panin Bank Syariah(517)</option>
                                                <option value="Prima Master(520)">Prima Master(520)</option>
                                                <option value="KB Bukopin Syariah(521)">KB Bukopin Syariah(521)</option>
                                                <option value="Sampoerna(523)">Sampoerna(523)</option>
                                                <option value="OK Bank(526)">OK Bank(526)</option>
                                                <option value="Amar Bank(531)">Amar Bank(531)</option>
                                                <option value="Sea Bank(535)">Sea Bank(535)</option>
                                                <option value="BCA Syariah(536)">BCA Syariah(536)</option>
                                                <option value="Bank Jago(542)">Bank Jago(542)</option>
                                                <option value="BTPN Syariah(547)">BTPN Syariah(547)</option>
                                                <option value="Bank MAS(548)">Bank MAS(548)</option>
                                                <option value="Bank Fama(562)">Bank Fama(562)</option>
                                                <option value="Mandiri Taspen(564)">Mandiri Taspen(564)</option>
                                                <option value="Victoria Internasional(566)">Victoria Internasional(566)</option>
                                                <option value="Allo Bank(567)">Allo Bank(567)</option>
                                                <option value="Bank Jabar(110)">Bank Jabar(110)</option>
                                                <option value="Bank DKI(111)">Bank DKI(111)</option>
                                                <option value="BPD DIY(112)">BPD DIY(112)</option>
                                                <option value="Bank Jateng(113)">Bank Jateng(113)</option>
                                                <option value="Bank Jatim(114)">Bank Jatim(114)</option>
                                                <option value="Bank Jambi(115)">Bank Jambi(115)</option>
                                                <option value="Bank Aceh(116)">Bank Aceh(116)</option>
                                                <option value="Bank Sumut(117)">Bank Sumut(117)</option>
                                                <option value="Bank Nagari(118)">Bank Nagari(118)</option>
                                                <option value="Bank Riau Kepri(119)">Bank Riau Kepri(119)</option>
                                                <option value="Bank SumselBabel(120)">Bank SumselBabel(120)</option>
                                                <option value="Bank Lampung(121)">Bank Lampung(121)</option>
                                                <option value="Bank BPD Kalsel(122)">Bank BPD Kalsel(122)</option>
                                                <option value="Bank Kalbar(123)">Bank Kalbar(123)</option>
                                                <option value="Bank Kaltim(124)">Bank Kaltim(124)</option>
                                                <option value="Bank Kalteng(125)">Bank Kalteng(125)</option>
                                                <option value="Bank Sulsel(126)">Bank Sulsel(126)</option>
                                                <option value="Bank SulutGo(127)">Bank SulutGo(127)</option>
                                                <option value="Bank NTB(128)">Bank NTB(128)</option>
                                                <option value="Bank BPD Bali(129)">Bank BPD Bali(129)</option>
                                                <option value="Bank BPD NTT(130)">Bank BPD NTT(130)</option>
                                                <option value="Bank Maluku(131)">Bank Maluku(131)</option>
                                                <option value="Bank Papua(132)">Bank Papua(132)</option>
                                                <option value="Bank Bengkulu(133)">Bank Bengkulu(133)</option>
                                                <option value="Bank Sulteng(134)">Bank Sulteng(134)</option>
                                                <option value="Bank Banten(137)">Bank Banten(137)</option>
                                                <option value="Citibank (031)">Citibank (031)</option>
                                                <option value="JP Morgan Chase(032)">JP Morgan Chase(032)</option>
                                                <option value="Bank Of America(033)">Bank Of America(033)</option>
                                                <option value="MUFG (042)">MUFG (042)</option>
                                                <option value="Standard Chartered(050)">Standard Chartered(050)</option>
                                                <option value="Deutsche Bank (067)">Deutsche Bank (067)</option>
                                                <option value="Bank Of China(069)">Bank Of China(069)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingKeterangan"><i class="fa fa-code-fork"></i> Bank
                                                Branch</label>
                                            <input type="text" class="form-control" id="floatingKeterangan"
                                                placeholder="Email" name="cabang_bank" value="{{ $dv->cabang_bank }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingKeterangan"><i class="fa fa-user"></i> Recipient's
                                                Name</label>
                                            <input type="text" class="form-control" id="floatingKeterangan"
                                                placeholder="Email" name="nama_penerima"
                                                value="{{ $dv->nama_penerima }}">
                                        </div>
                                    </div>
                                    <div style="text-align: right;">
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        <a type="reset" class="btn btn-dark mt-3"
                                            href="{{ url('/menu-perusahaan/') }}">Back</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
    </section>
@endsection
