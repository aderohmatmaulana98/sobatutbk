<div id="app">
    <!-- BEGIN: Top Bar -->
    <header class="top-bar">
        <div class="top-bar-content">
            <!-- BEGIN: Logo -->
            <span class="hidden md:flex items-center h-full mr-auto">SobatUTBK: Tryout</span>
            <!-- END: Logo -->
            <!-- BEGIN: Navigation icon -->
            <a class="flex md:hidden items-center h-full mr-auto px-5 -ml-5" id="nav-button" @click="is_menu_opened = !is_menu_opened" href="javascript:;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2 w-5 h-5 transform rotate-90">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
            </a>
            <!-- END: Navigation icon -->
            <!-- BEGIN: Time -->
            <div class="flex md:hidden relative h-full items-center">
                <div class="block">
                    <div class="w-24 text-xs truncate font-medium leading-tight">Waktu tersisa:</div>
                    <div class="text-lg text-white">{{ formatedTime }}</div>
                </div>
            </div>
            <!-- END: Time -->
        </div>
    </header>
    <!-- END: Top Bar -->

    <!-- BEGIN: Side menu -->
    <aside :class="is_menu_opened ? 'block' : 'hidden'" class="side-menu side-menu-siswa transition duration-500 md:block top-0 left-0 fixed w-72 h-screen">
        <div>
            <div class="hidden md:block">
                <p class="font-medium text-2xl text-white pt-2 text-center w-full leading-relaxed">
                    Waktu Tersisa<br>
                    <span class="font-bold text-3xl">{{ formatedTime }}</span><br>
                    Ujian <?= $exam_name ?>
                </p>
            </div>
            <div class="mt-3 grid items-center justify-center w-full px-4 py-1 text-base text-blue">
                <div class="flex flex-row items-center p-2">
                    <span class="w-3 h-3 rounded bg-white border-0 mr-2"></span>
                    <span>Belum Dijawab</span>
                </div>
                <div class="flex flex-row items-center p-2">
                    <span class="w-3 h-3 rounded bg-yellow-300 border-0 mr-2"></span>
                    <span>Sedang Dijawab</span>
                </div>
                <div class="flex flex-row items-center p-2">
                    <span class="w-3 h-3 rounded bg-green-500 border-0 mr-2"></span>
                    <span>Sudah Dijawab</span>
                </div>
            </div>
            <div class="mb-6">
                <ul class="mt-3 leading-10">
                    <?php
                    foreach ($list_categories as $category) :
                    ?>
                        <li class="relative px-2 py-1">
                            <div :class="list_questions['is_menu_opened'] && <?php if ($category['slug'] == $current) { ?> true <?php } else { ?> false <?php } ?> ? 'rounded-t-md' : 'rounded-md'" <?php if ($category['slug'] == $current) { ?> @click="list_questions['is_menu_opened'] = !list_questions['is_menu_opened']" <?php } ?> class="transition duration-300 ease-in-out inline-flex values-center justify-between w-full text-base py-2 font-semibold text-white bg-orange hover:bg-blue cursor-pointer">
                                <span class="inline-flex values-center text-base font-semibold capitalize">
                                    <span class="ml-4"><?= implode($category['name']); ?></span>
                                </span>
                                <?php
                                if ($category['slug'] == $current) {
                                ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-2 text-white w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <!-- Icon Dropdown: Left -->
                                        <path v-if="!list_questions['is_menu_opened']" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        <!-- Icon Dropdown: Down -->
                                        <path v-if="list_questions['is_menu_opened']" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                <?php } else { ?>
                                    <svg class="mx-2 text-white w-6 h-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <!-- Icon Locked -->
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <rect x="5" y="11" width="14" height="10" rx="2" />
                                        <circle cx="12" cy="16" r="1" />
                                        <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                                    </svg>
                                <?php } ?>
                            </div>

                            <?php
                            if ($category['slug'] == $current) {
                            ?>
                                <div v-show="list_questions['is_menu_opened']" class="flex flex-wrap mb-2 bg-gray-200 rounded-b-md p-2 text-lg content-evenly">
                                    <span v-for="n in list_questions['total']" :class="(id == n-1) && !list_questions.bank_soal[n-1].is_done ? 'bg-yellow-300 font-medium' : (id == n-1) && (list_questions.bank_soal[n-1].is_done) ? 'bg-yellow-300 font-medium' : list_questions.bank_soal[n-1].is_done ? 'bg-green-500 text-white' : 'bg-white'" class="transition duration-300 ease-in-out flex-grow p-2 m-1 w-10 h-10 rounded-md text-center cursor-pointer hover:underline" @click="jump_question(n-1)">{{ n }}</span>
                                </div>
                            <?php
                            }
                            ?>
                        </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </aside>
    <!-- END: Side menu -->

    <!-- BEGIN: Content -->
    <div class="md:pl-72 pt-16" :class="isTimeOut || (!is_test_started || is_test_started == 'false') ? 'filter blur-md' : ''">
        <div class="w-full md:w-full lg:w-3/4 p-6 mx-auto">
            <div class="text-2xl font-semibold capitalize">Soal {{list_questions.category }} No.{{ id+1 }}</div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <!-- BEGIN: Panel Soal -->
                <div class="col-span-12">
                    <div class="content-box p-4 bg-white rounded-md drop-shadow-lg">
                        <div class="text-base m-4 mb-6">
                            <p v-html="list_questions.bank_soal[id].soal"></p>
                        </div>
                        <div class="m-4">
                            <label v-for="(answer, index) in list_questions.bank_soal[id].opt" :key="index" :for="index" class="transition duration-300 ease-in-out block mt-4 border border-gray-300 rounded-lg py-2 px-6 text-lg cursor-pointer" :class="{'hover:bg-gray-100' : selected_answer == '', 'bg-green-200' : selected_answer === index}">
                                <input :id="index" type="radio" class="hidden" :value="index" @click="is_done($event)" :disable="!selected_answer === ''" />
                                <p v-html="answer"></p>
                            </label>
                        </div>
                    </div>
                    <div class="mt-6 flow-root" v-show="selected_answer != ''">
                        <!-- Status Answer Saved -->
                        <p v-if="is_answer_saved == false" class="float-right m-2 text-yellow-400 text-sm font-bold tracking-wide rounded-full px-5 py-2">Sedang menyimpan jawaban...</p>
                        <!-- Tombol Selesai -->
                        <button @click="finish_test" v-show="id == list_questions.total - 1 && is_answer_saved == true" class="float-right m-2 bg-blue text-white text-sm font-bold tracking-wide rounded-full px-5 py-2">Selesai</button>
                        <!-- Tombol Soal Selanjutnya -->
                        <button @click="next_question" v-show="id < list_questions.total - 1 && is_answer_saved == true" class="float-right m-2 bg-orange-dark hover:bg-blue text-white text-sm font-bold tracking-wide rounded-full px-5 py-2">Selanjutnya &gt;</button>
                        <!-- Tombol Soal Sebelumnya -->
                        <button @click="previous_question" v-show="id > 0" class="float-right m-2 bg-orange-dark hover:bg-blue text-white text-sm font-bold tracking-wide rounded-full px-5 py-2">&lt; Sebelumnya</button>
                        <p v-if="is_answer_saved == 'error'" class="float-right m-2 text-red-400 text-sm font-bold tracking-wide rounded-full px-5 py-2">Gagal menyimpan jawaban, cek kembali koneksi internet Anda.</p>
                        <p v-if="is_answer_saved == true" class="float-right m-2 text-green-500 text-sm font-bold tracking-wide rounded-full px-5 py-2">Jawaban berhasil disimpan.</p>
                    </div>
                </div>
                <!-- END: Panel Soal -->
            </div>
        </div>
    </div>
    <!-- END: Content -->

    <!-- BEGIN: Modal Ujian Selesai -->
    <div :class="is_modal_shown ? 'block' : 'hidden'" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
                    Background overlay, show/hide based on modal state.

                    Entering: "ease-out duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                    Leaving: "ease-in duration-200"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!--
                    Modal panel, show/hide based on modal state.

                    Entering: "ease-out duration-300"
                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        To: "opacity-100 translate-y-0 sm:scale-100"
                    Leaving: "ease-in duration-200"
                        From: "opacity-100 translate-y-0 sm:scale-100"
                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10" :class="isTimeOut ? 'bg-yellow-100' : 'bg-green-100'">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg :class="isTimeOut ? 'text-yellow-500' : 'text-green-500'" class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- ICON: Done -->
                                <path v-if="!isTimeOut" stroke="none" d="M0 0h24v24H0z" />
                                <path v-if="!isTimeOut" d="M5 12l5 5l10 -10" />
                                <!-- ICON: Clock -->
                                <path v-if="isTimeOut" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 v-if="!isTimeOut" class="text-xl leading-6 font-medium text-gray-900" id="modal-title">
                                Ujian Selesai!
                            </h3>
                            <h3 v-else class="text-xl leading-6 font-medium text-gray-900" id="modal-title">
                                Waktu Habis!
                            </h3>
                            <div class="mt-2">
                                <p class="text-lg text-gray-500">
                                    Semoga Ujian yang Telah Anda Kerjakan Hasilnya Memuaskan!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <input :value="list_questions.next === 'exit' ? 'Kembali ke Dashboard' : 'Pergi ke Ujian Selanjutnya'" @click="next_type_question" type="submit" class="w-full cursor-pointer inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange text-base font-medium text-white hover:bg-blue focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-light sm:ml-3 sm:w-auto sm:text-sm" />
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal Ujian Selesai -->

    <!-- BEGIN: Modal Mulai Ujian -->
    <div :class="(!is_test_started || is_test_started == 'false') && !isTimeOut ? 'block' : 'hidden'" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
                    Background overlay, show/hide based on modal state.

                    Entering: "ease-out duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                    Leaving: "ease-in duration-200"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!--
                    Modal panel, show/hide based on modal state.

                    Entering: "ease-out duration-300"
                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        To: "opacity-100 translate-y-0 sm:scale-100"
                    Leaving: "ease-in duration-200"
                        From: "opacity-100 translate-y-0 sm:scale-100"
                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10 bg-yellow-100">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="h-8 w-8 text-yellow-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M15 7v-4h-12v12.01h4" stroke-dasharray=".001 4" />
                                <path d="M19 11v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" />
                                <path d="M13 13l9 3l-4 2l-2 4l-3 -9" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-xl leading-6 font-medium text-gray-900" id="modal-title">
                                Baca sebelum Mengerjakan!
                            </h3>
                            <div class="mt-2">
                                <p class="text-lg text-gray-500">
                                <ul class="list-outside list-disc">
                                    <li>Pastikan koneksi internet Anda saat ini stabil agar jawaban dapat tersimpan.</li>
                                    <li>Ketika ingin melanjutkan ke tes selanjutnya pastikan Anda terhubung dengan internet.</li>
                                    <li>Jangan melakukan pemuatan ulang (refresh/reload) saat mengerjakan soal.</li>
                                    <li>Gunakan waktu sebaik mungkin dalam mengerjakan tes.</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <input value="Mulai Mengerjakan" @click="start_test" type="submit" class="w-full cursor-pointer inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange text-base font-medium text-white hover:bg-blue focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-light sm:ml-3 sm:w-auto sm:text-sm" />
                    <span class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-red-500 sm:ml-3 sm:w-auto sm:text-sm">Ujian akan dimulai dalam {{ countdown_start }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal Mulai Ujian -->

</div>