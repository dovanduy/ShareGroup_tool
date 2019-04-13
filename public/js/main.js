var promise = [];
var count = 0;

var btnGetToken = $('#btnGetToken');

btnGetToken.click(function () {
    $('#tblResult tbody').html("");
    count = 0;
    promise = [];

    var listCookie = $('#in_cookie').val().trim();

    if (listCookie.length != 0) {
        var arrCookie = listCookie.split('\n');

        btnGetToken.attr('disabled', 'disabled');
        var i = 1;
        var stt = 'Đang lấy token ';
        var time = setInterval(function () {
            stt += '.'
            if (i % 5 == 0) {
                stt = 'Đang lấy token ';
            }
            btnGetToken.html(stt);
            i++;
        }, 1000);

        for (i in arrCookie) {
            promise.push(getToken(arrCookie[i]));
        }

        Promise.all(promise).then(function () {
            clearInterval(time);
            btnGetToken.html("Lấy Token");
            btnGetToken.removeAttr('disabled');
            alert("Hoàn thành\n" + count + " tài khoản đã lấy được token");
        });

    } else {
        alert("Danh sách cookie rỗng");
    }
});


var btnShareGroup = $('#btnShareGroup');

btnShareGroup.click(function () {
    var listCookie = $('#inCookie').val().trim();
    var mess = $('#inMessage').val().trim();
    var link = $('#inLink').val().trim();
    var limit = $('#inLimit').val().trim();
    var withoutApproval = $('#chkOnlyWithoutApproval').is(':checked');

    if (listCookie.length != 0) {
        $('#tblResult tbody').html("");
        count = 0;
        promise = [];

        btnShareGroup.attr('disabled', 'disabled');
        var i = 1;
        var stt = 'Đang chia sẻ ';
        var time = setInterval(function () {
            stt += '.'
            if (i % 5 == 0) {
                stt = 'Đang chia sẻ ';
            }
            btnShareGroup.html(stt);
            i++;
        }, 1000);

        var arrCookie = listCookie.split('\n');

        for (i in arrCookie) {
            promise.push(shareGroup(arrCookie[i], mess, link, limit, withoutApproval));
        }

        Promise.all(promise).then(function () {
            clearInterval(time);
            btnShareGroup.html("Chia sẻ");
            btnShareGroup.removeAttr('disabled');
            alert("Hoàn thành\nĐã chia sẻ lên " + count + " group");
        }, function () {
            clearInterval(time);
            btnShareGroup.html("Chia sẻ");
            btnShareGroup.removeAttr('disabled');
            alert("Hoàn thành");
        });

    } else {
        alert("Danh sách cookie rỗng");
    }

});

function getToken(cookie) {
    return new Promise(function (resolve, reject) {
        $.post("ajax.php", {
            request: "get_token",
            cookie: cookie
        }, function (res) {
            try {
                res = JSON.parse(res);
                resolve(res);
            } catch (e) {
                reject();
            }
        });
    }).then(function (res) {
        if (res.token != false) {
            var row = createTableRow([++count, res.uid, res.token]);
            var tblResult = $('#tblResult tbody')[0];
            tblResult.appendChild(row);
        }
    }).catch(function () {

    });
}

function shareGroup(cookie, mess, link, limit, withoutApproval) {
    return new Promise(function (resolve, reject) {
        $.post(
            "ajax.php", {
                request: "share_group",
                cookie: cookie,
                message: mess,
                link: link,
                limit: limit,
                without_approval: withoutApproval
            },
            function (res) {
                try {
                    res = JSON.parse(res);
                    resolve(res);
                } catch (e) {
                    reject();
                }
            }
        );
    }).then(function (res) {
        for (i in res){
            count++;
            var row = createTableRow([count, res[i].id, res[i].name, res[i].viewer_post_status, res[i].visibility]);
            var tblResult = $('#tblResult tbody')[0];
            tblResult.appendChild(row);
        }
    }).catch(function (val) {

    });
}

function createTableRow(cols) {
    var tr = document.createElement("tr");
    for (i in cols) {
        var td = document.createElement("td");
        td.innerHTML = cols[i];
        tr.appendChild(td);
    }

    return tr;
}

