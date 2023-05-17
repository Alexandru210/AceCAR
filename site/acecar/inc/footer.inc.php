                <footer class="container py-5 text-center bottom">
                    <div class="py-3">
                        <a href="https://instagram.com"><i class="fa fa-instagram text-dark fa-xl px-2"></i></a>
                        <a href="https://instagram.com"><i class="fa fa-facebook text-dark fa-xl px-2"></i></a>
                        <a href="https://instagram.com"><i class="fa fa-twitter text-dark fa-xl px-2"></i></a>
                    </div>
                    <div class="pt-3 font-bold2">
                        <div class="display-inline px-3"><a href="help.html">Ajutor</a></div>
                        <div class="display-inline px-3"><a href="help.html">Informatii generale</a></div>
                        <div class="display-inline px-3"><a href="help.html">Termeni si conditii</a></div>
                    </div>
                </footer>
            </div>

        <script>
            feather.replace()

            const toastTrigger = document.getElementById('liveToastBtn')
            const toastLiveExample = document.getElementById('liveToast')
            if (toastTrigger) {
                toastTrigger.addEventListener('click', () => {
                    const toast = new bootstrap.Toast(toastLiveExample)

                    toast.show()
                })
            }

            function showNotif(){
                const toastLiveExample = document.getElementById('liveToast')
                const toast = new bootstrap.Toast(toastLiveExample)

                toast.show()
            }
        </script>
    </body>

</html>