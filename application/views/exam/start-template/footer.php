<script>
    Vue.config.devtools = true;
    new Vue({
        data() {
            return {
                id: 0,
                is_menu_opened: false,
                countdown: <?= $exam_time ?>,
                countdown_start: 15,
                is_test_started: false,
                total_category: <?= $count_category; ?>,
                list_questions: <?= $list_questions; ?>,
                is_modal_shown: false,
                is_modal2_hidden: false,
                is_answer_saved: '',
                selected_answer: '',
            }
        },
        created() {
            for (let index = 0; index < this.list_questions.bank_soal.length; index++) {
                let soal = this.list_questions.bank_soal[index]
                if (soal.is_done == true) {
                    if (this.id < this.list_questions.bank_soal.length - 1) {
                        this.id++
                    }
                }
            }
            this.check_answer()
        },
        mounted() {
            if (localStorage.is_test_started) {
                if (localStorage.is_test_started == 'next') {
                    this.is_test_started = false
                } else {
                    this.is_test_started = localStorage.is_test_started
                }
            }

            if (this.is_test_started) {
                this.countdown_start = 0
            }

            this.countdown_timer()
            this.countdown_start_test()
        },
        watch: {
            is_test_started(newValue) {
                localStorage.is_test_started = newValue
            }
        },
        methods: {
            start_test() {
                this.is_test_started = true
            },
            dismiss_modal2() {
                this.is_modal2_hidden = true
            },
            is_done(e) {
                if (!this.isTimeOut) {
                    this.is_answer_saved = false
                    this.selected_answer = e?.target?.value || ''

                    //update answer
                    $.ajax({
                        url: "<?= base_url('Exm/update_answer'); ?>",
                        method: "POST",
                        context: this,
                        data: {
                            id: this.list_questions.bank_soal[this.id].user_exam_answer_id,
                            answer: this.selected_answer
                        },
                        dataType: 'json',
                        success: function(data) {
                            // save answer to local
                            this.is_answer_saved = true
                            this.list_questions.bank_soal[this.id].is_done = true
                            this.list_questions.bank_soal[this.id].answer = this.selected_answer
                            console.log(data)
                        },
                        error: function(request, error) {
                            this.is_answer_saved = 'error'
                        }

                    });
                }
            },
            next_question() {
                this.is_answer_saved = false
                this.id++
                this.check_answer()
            },
            previous_question() {
                this.is_answer_saved = false
                this.id--
                this.check_answer()
            },
            jump_question(selected_id) {
                this.is_answer_saved = false
                this.id = selected_id
                this.check_answer()
            },
            check_answer() {
                // the question is done / answered?
                if (this.list_questions.bank_soal[this.id].is_done) {
                    this.is_answer_saved = true
                    this.selected_answer = this.list_questions.bank_soal[this.id].answer
                } else {
                    this.selected_answer = ''
                    document.querySelectorAll('input').forEach(el => el.checked = false)
                }
            },
            next_type_question() {
                this.is_test_started = 'next'
                window.location.href = '<?= base_url('exm/next_mapel/'); ?>' + this.list_questions.next
            },
            finish_test() {
                this.is_answer_saved = false
                this.is_modal_shown = true
            },
            countdown_timer() {
                if (!this.isTimeOut) {
                    setTimeout(() => {
                        this.countdown -= 1
                        this.countdown_timer()
                    }, 1000)
                } else {
                    this.finish_test()
                }
            },
            countdown_start_test() {
                if (!this.isTimeOut) {
                    if (!this.isTestStarted) {
                        setTimeout(() => {
                            this.countdown_start -= 1
                            this.countdown_start_test()
                        }, 1000)
                    } else {
                        this.is_test_started = true
                    }
                }
            }
        },
        computed: {
            isTimeOut() {
                return this.countdown <= 0
            },
            formatedTime() {
                let hour = parseInt(this.countdown % (24 * 3600) / 3600) // remaining hours
                let minute = parseInt(this.countdown % 3600 / 60) // minutes remaining
                let second = parseInt(this.countdown % 60) // seconds remaining

                return `${hour}:${minute}:${second}`
            },
            isTestStarted() {
                return this.countdown_start <= 0
            }
        }
    }).$mount('#app');
</script>

</body>

</html>