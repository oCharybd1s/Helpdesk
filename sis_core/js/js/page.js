// default Var for Page
// var history_page = [{data: {}, title: "<i class='fa fa-desktop'></i> Dashboard", url: "dashboard"}];
var history_page = [
  {
    url: "example/dashboard",
    title: "<i class='fa fa-list'></i> Dashboard",
    data: {},
  },
];
var datatable;
var _post={};
var select2;
class Page {
  constructor(base_url, glob_page, id_user = 0) {
    this.base_url = base_url;
    this.glob_page = glob_page;

    if (myStorage.getStorage("history").length > 0) {
      history_page = myStorage.getStorage("history");
    }

    if (id_user > 0) {
      this.reload();
    }
  }

  view(file_name, title = "", data = {}) {
    var url = this.base_url + "/getPage?file_name=" + file_name;
    swalLoading("proses . . .");
    setTimeout(function () {
      _post=data;
      $("#rutan_title").html(title);
      $("#rutan_content").load(url, data, function () {
        if (history_page.length > 0) {
          var last = history_page.slice(-1)[0];
          if (file_name != last.url) {
            history_page.push({ url: file_name, title: title, data: data });
          }
        } else {
          history_page.push({ url: file_name, title: title, data: data });
        }
        myStorage.setVariable("history", history_page);
        disableBack();
        swal.close();

        if ($(".datatable").length != 0) {
          datatable = $(".datatable").DataTable();
        }
        if ($(".select2").length != 0) {
          select2 = $(".select2").select2();
        }
      });
    }, 500);
  }

  directTo(url = "") {
    document.location.href = this.base_url + url;
  }

  reload() {
    if (myStorage.getStorage("history").length > 0) {
      history_page = myStorage.getStorage("history");
    }
    //untuk menuju lokasi terakhir
    var last = this.historyLast();
    this.view(last.url, last.title, last.data);
  }

  historyLast() {
    if (history_page.length > 0) {
      return history_page.slice(-1)[0];
    } else {
      return [
        {
          data: {},
          title: "<i class='fa fa-desktop'></i> Dashboard",
          url: "gps_dashboard",
        },
      ];
    }
  }

  backhistory() {
    if (history_page.length > 1) {
      history_page.pop();
      myStorage.setVariable("history", history_page);
    }
    this.reload();
    // return history_page.slice(-1)[0];
  }

  updateHistory() {
    // console.log([history_page, myStorage.getStorage('history')]);
    if (
      this.historyLast().url != myStorage.getStorage("history").slice(-1)[0].url
    ) {
      myStorage.setVariable("history", history_page);
    }
  }
}
