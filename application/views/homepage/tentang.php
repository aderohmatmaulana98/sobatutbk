<!-- Cover -->
<div class="container text-baloo py-5 mt-5">
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <h1 class="text-orange"><?= $master[30]['isi'] ?></h1>
            <p><?= $master[31]['isi'] ?></p>
            <h3 class="text-orange"><?= $master[32]['isi'] ?></h3>
            <p><?= $master[33]['isi'] ?></p>
            <h3 class="text-orange"><?= $master[34]['isi'] ?></h3>
            <p>
            <ul>
                <?php foreach ($misi as $m) : ?>
                    <li><?= $m['isi'] ?></li>
                <?php endforeach; ?>
            </ul>
            </p>
        </div>
    </div>
</div>
<!-- Akhir Cover -->
</div>

<!-- F&Q -->
<div class="container  text-baloo py-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-1 judul-fnq text-orange"><?= $master[35]['isi'] ?></h1>
        </div>


        <?php $no = 1;
        foreach ($faq as $f) : ?>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h4 class="question text-biru" onclick="toggleFAG(<?= $no; ?>)" id="quest<?= $no; ?>">
                    <?= $f['tanya'] ?>
                    <p class="text-orange" id="answer<?= $no; ?>">
                        <?= $f['jawab'] ?>
                    </p>
                </h4>
            </div>
            <div class="col-md-1"></div>
        <?php $no++;
        endforeach; ?>
        <label name="<?= $no - 1; ?>" id="jml-fag" class="d-none"></label>

        <!-- 
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest2">
                Apa kelebihan simulasi tryout di SOBAT UTBK dengan layanan simulasi – simulasi
                tryout lainnya ?
                <p class="answer2 text-orange">
                    Sobat UTBK menggunakan sistem penilaian IRT yang sesuai dengan sistem real pelaksanaan UTBK,
                    dengan assesement repot yang lengkap disertai dengan rasionalisasi nilai serta analisis dan
                    rekomendasi PTN yang dituju, soal prediktif dan terupdate sesuai standar LTMPT. SobatUTBK juga
                    melayani konsultasi pemilihan jurusan sesuai dengan kemampuan dan keingininan siswa.
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest3">
                Apakah di SOBAT UTBK tersedia layanan konsultasi jurusan untuk para siswa ?
                <p class="answer3 text-orange">
                    Sobat UTBK melayani konsultasi siswa, yang betujuan untuk membantu siswa memilih jurusan yang
                    tepat sesuai kemampuan dan keinginannya.
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest4">
                Bagaimana cara mendaftar Tryout di Sobat UTBK?
                <p class="answer4 text-orange">
                    Cara mendaftar Tryout di SobatUTBK dengan mengakses web <a href=" http://app.sobatutbk.com/">app.sobatutbk.com</a> dan masuk ke
                    menu “DAFTAR” , kemudian mengisi data diri untuk dapat melanjutkan pendaftaran. User akan
                    menerima password untuk LOGIN yang akan dikirimkan ke whatsapp user
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest5">
                Bagaimana cara membeli paket di sobatUTBK?
                <p class="answer5 text-orange">
                    Paket tryout sobat UTBK ada di menu “BELI PAKET”, klik paket yang akan dibeli dan lanjutkan ke
                    pembayaran.
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest6">
                Bagaimana saya dapat melakukan pembayaran?
                <p class="answer6 text-orange">
                    Pembayaran dapat dilakukan melalui Transfer bank, Gopay, atau DANA
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest7">
                Kapan saya dapat mengerjakan Tryout?
                <p class="answer7 text-orange">
                    Tryout dapat dikerjakan kapan saja dengan memilih sesi yang tersedia pada setiap tanggalnya
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest8">
                Untuk hasil ujian di SOBAT UTBK hanya sebatas skor/nilai saja atau ada
                pembahasan materi di setiap butiran soalnya ?
                <p class="answer8 text-orange">
                    Hasil ujian di sobat UTBK berupa skor permapel dan juga skor total serta terdapat rasionalisasi
                    nilai dan grafik pencapaian hasil tryout. Pembahasan setiap item soal akan berikan dan dapat
                    diakses peserta tryout setelah periode Tryout berakhir
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest9">
                Kenapa harga/biaya paket tryout di SOBAT UTBK lebih mahal daripada di tempat
                Lainnya?
                <p class="answer9 text-orange">
                    1. Soal yang digunakan standar Nasional <br>
                    2. Report mendalam setiap mata pelajaran <br>
                    3. Sistem IRT yang yang preditifjhb <br>
                    4. Konsultasi jurusan. <br>
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest10">
                Jenis soal tryout di SOBAT UTBK sama saja kan dengan jenis soal AKM di tempat
                lainnya ?
                <p class="answer10 text-orange">
                    Berbeda. Jenis soal tryout UTBK tentunya berbeda dengan jenis soal AKM. AKM merupakan
                    Assessement Kompetensi Minimun yang digunakan sebagai pengganti UNBK. AKM mengacu pada soal-soal
                    numerasi, literasi dan survey karakter siswa.
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest11">
                Kenapa hasil skor/nilainya tidak langsung keluar ? Saya harus menunggu sampai
                tanggal 27 setiap bulannya.
                <p class="answer11 text-orange">
                    Sobat UTBK menggunakan sistem penilaian IRT (Item Response Theory) Setiap butir soal yang benar
                    akan dianalisis karakteristiknya. Salah satu cara analisis ini adalah dengan membandingkan
                    tingkat kesulitan setiap butir soal dengan soal yang lain. Ketiga, nilai UTBK setiap peserta
                    dihitung berdasarkan pada analisis karakteristik soal diatas. Soal yang relatif sulit akan
                    menghasilkan bobot nilai lebih tinggi dibanding yang lain. Artinya, semakin banyak peserta UTBK
                    yang menjawab benar pada satu soal maka bobot nilai soal tersebut semakin kecil. Dan sebaliknya,
                    semakin banyak jawaban salah pada suatu soal maka bobot nilai soal tersebut semakin besar.
                    Sehingga untuk analisis dapat dilakukan kolektif dengan peserta tryout lain.
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest12">
                Apa saya bisa mengikuti tryout SOSHUM dan SAINTEK sekaligus di satu
                waktu/sesi ?
                <p class="answer12 text-orange">
                    Bisa jika user memilih paket campuran di sobat UTBK
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest13">
                Bisa minta contoh lampiran soalnya ? Dan contoh pembahasan per soalnya juga ?
                <p class="answer13 text-orange">
                    Soal dan pembahasan dapat di akses setelah user membeli paket dan periode tryout berakhir
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h4 class="question text-biru" id="quest14">
                Apa ada layanan simulasi free trial untuk tryout di SOBAT UTBK ?
                <p class="answer14 text-orange">
                    Ada, layanan Truyout gratis tersedia di Sobat UTBK
                </p>
            </h4>
        </div>
        <div class="col-md-1"></div> -->


    </div>
</div>
<!-- Akhir F&Q -->

<hr>