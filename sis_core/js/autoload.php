<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script> -->
<!-- <script src="<?= sis_core('js/js/gmap.js') ?>"></script> -->
<script src="<?= sis_core('js/js/default.js') ?>?random=<?= uniqid(); ?>"></script>
<script src="<?= sis_core('js/js/sweetalert2.js') ?>?random=<?= uniqid(); ?>"></script>


<!-- excell Report -->
<script src="<?= sis_core('js/plugins/alasql/alasql.min.js') ?>?random=<?= uniqid(); ?>"></script>
<script src="<?= sis_core('js/plugins/alasql/xlsx.core.min.js') ?>?random=<?= uniqid(); ?>"></script>

<script src="<?= sis_core('js/plugins/alasql/excel_generator.js') ?>?random=<?= uniqid(); ?>"></script>
<script src="<?= sis_core('js/plugins/alasql/my_localstorage.js') ?>?random=<?= uniqid(); ?>"></script>
<script src="<?= sis_core('js/js/page.js') ?>?random=<?= uniqid(); ?>"></script>
<script type="text/javascript">
    let excel = new ExcelReport();
    let myStorage = new MyLocalStorage();

    var _api_rutan = '<?= api_rutan ?>';

    var session_login = {
        login: <?= isset($_SESSION[_session_app_id]) ? json_encode($_SESSION[_session_app_id]) : json_encode([]) ?>
    };
    var base_url = "<?= base_url() ?>";
    let page = new Page(base_url, "<?= glob_page() ?>", <?= $_SESSION[_session_app_id]['id'] ?>);

    if (typeof session_login.login == 'undefined' || typeof session_login.login.id == 'undefined') {
        myStorage.clearStorage();
        var history_page = [];
    } else {
        if (typeof history_page == 'undefined' || history_page.length == 0) {
            var history_page = [{
                "url": "dashboard",
                "title": "<i class='fa fa-list'></i> Dashboard",
                "data": {}
            }];
        } else {
            page.reload();
        }
    }

    // function setWorker() {
    //     var workerCode_notif = `
    //     self.addEventListener('message', function(e) {
    //         funWorkerSession(e.data);
    //     });

    //     function funWorkerSession(base_url){
    //         var start_ms = performance.now();
    //         var url = '${base_url}post?target=getLoginSession';
    //         fetch(url)
    //         .then(response => response.json())
    //         .then(data_session => {
    //             var end_ms = performance.now();
    //             var exec_time = (end_ms - start_ms)/1000;
    //             self.postMessage({tipe:'session',result:data_session});
    //         })
    //         .catch(error => {
    //             var end_ms = performance.now();
    //             var exec_time = (end_ms - start_ms)/1000;

    //             var data_session = {id:'error', session_status:0};
    //             self.postMessage({tipe:'session',result:data_session});
    //         });
    //     }
    //     `;

    //     var blob_notif = new Blob([workerCode_notif], {
    //         type: 'application/javascript'
    //     });
    //     var blobURL_notif = URL.createObjectURL(blob_notif);
    //     var worker = new Worker(blobURL_notif);

    //     worker.addEventListener('message', function(e) {
    //         var tipe = e.data.tipe;
    //         var result = e.data.result;
    //         var stay = true;
    //         if (result.status == 'success') {
    //             if (typeof result.data === 'undefined' || typeof result.data.id === 'undefined') {
    //                 stay = false;
    //             }
    //         } else {
    //             stay = false;
    //         }
    //         if (stay) {
    //             setTimeout(function() {
    //                 worker.postMessage(base_url);
    //             }, 5000);
    //         } else {
    //             Swal.fire('session login telah habis!');
    //             setTimeout(() => {
    //                 page.directTo('logout');
    //             }, 500);
    //         }

    //     });
    //     worker.postMessage(base_url);
    // }
</script>