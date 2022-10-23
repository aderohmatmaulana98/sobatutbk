    <footer class="px-4 md:px-12 lg:px-24 divide-y bg-white">
        <div class="container flex flex-col justify-between py-10 mx-auto space-y-8 lg:flex-row lg:space-y-0">
            <div class="lg:w-1/4">
                <a href="#" class="flex flex-row justify-center space-x-3 lg:justify-start">
                    <div class="flex items-center justify-center w-24 h-16 rounded-full">
                        <img src="<?= base_url('asset/homepage/img'); ?>/logo-2.png" alt="" class="w-auto">
                    </div>
                </a>
                <span class="block text-center lg:text-left lg:w-1/2 text-lg font-medium">Jl. Kaliurang km 10, Ruko A no 1, Sleman, Yogyakarta</span>
            </div>
            <div class="grid grid-cols-2 text-base gap-x-3 gap-y-8 lg:w-3/4 sm:grid-cols-3">
                <div class="space-y-3">
                    <h3 class="tracking-wide uppercase font-medium">Produk Kami</h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="#">Tryout UTBK</a>
                        </li>
                        <li>
                            <a href="#">Konsultasi</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <h3 class="tracking-wide uppercase font-medium">Tentang SobatUTBK</h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="<?= base_url('home/tentang'); ?>">Profil SobatUTBK</a>
                        </li>
                        <li>
                            <a href="<?= base_url('home/testimoni'); ?>">Testimoni</a>
                        </li>
                        <li>
                            <a href="#">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <div class="uppercase font-medium">Customer Service</div>
                    <div class="flex justify-start space-x-3">
                        <a href="//wa.me/+6285235010000" title="Facebook" class="flex items-center p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 32 32" class="w-5 h-5 fill-current" stroke="currentColor" stroke-width="2" stroke-linecap="round"  stroke-linejoin="round">
                                <path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg> 0852 3501 0000
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-6 text-sm text-center">© <?= date("Y") ?> SobatUTBK. All rights reserved.</div>
    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?= base_url('asset/homepage/js/app.js') ?>"></script>
</body>

</html>