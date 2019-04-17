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
            swal({
                text: "Hoàn thành\nĐã chia sẻ lên " + count + " group",
                icon: 'info',
            });
        }, function () {
            clearInterval(time);
            btnShareGroup.html("Chia sẻ");
            btnShareGroup.removeAttr('disabled');
            swal({text:"Hoàn thành", icon:'sucess'});
        });

    } else {
        alert("Danh sách cookie rỗng");
    }

});


//=========== Change Birthday ==================

var btnChangeBirthday = $('#btnChangeBirthday');

btnChangeBirthday.click(function(){
    var listCookie = $('#inCookie').val().trim();
    var dob = $('#inBirthday').val();
    var ck_dob = dob.split("/");
    var ck_dob_2 = ck_dob[2];
    // alert(ck_dob_2);
    if (listCookie.length != 0) {
        if (ck_dob_2 > 2000){
            swal({
                text: 'Năm sinh không được lớn hơn 2000',
                icon: 'warning',
                cancel: {
                    text: 'Đóng',
                    value: false,
                },
            })
        } else{
            $('#tblResult tbody').html("");
            count = 0;
            promise = [];

            btnChangeBirthday.attr('disabled', 'disabled');
            var i = 1;
            var stt = 'Đang Đổi Birthday ';
            var time = setInterval(function () {
                stt += '.'
                if (i % 5 == 0) {
                    stt = 'Đang Đổi Birthday ';
                }
                btnChangeBirthday.html(stt);
                i++;
            }, 1000);

            var arrCookie = listCookie.split('\n');

            for (i in arrCookie) {
                promise.push(changeBirth(arrCookie[i], dob));
            }

            Promise.all(promise).then(function () {
                clearInterval(time);
                btnChangeBirthday.html("Đổi Birthday");
                btnChangeBirthday.removeAttr('disabled');
                swal({
                    text: 'Hoàn thành\nĐã Đổi Birthday - ' + count + ' account',
                    icon: 'success',
                    cancel: {
                        text: 'Đóng',
                        value: false,
                    },
                })
            }, function () {
                clearInterval(time);
                btnChangeBirthday.html("Đổi Birthday");
                btnChangeBirthday.removeAttr('disabled');
                swal({
                    text: 'Hoàn thành',
                    icon: 'success',
                    cancel: {
                        text: 'Đóng',
                        value: false,
                    },
                })
            });
        }
    } else {
        swal({
            text: 'Danh sách cookie rỗng',
            icon: 'warning',
            cancel: {
                text: 'Đóng',
                value: false,
            },
        })
    }

});


function changeBirth(cookie, dob) {
    return new Promise(function (resolve, reject) {
        $.post(
            "ajax.php", {
                request: "change_dob",
                cookie: cookie,
                dob: dob,
            },
            function (res) {
                try {
                    res = JSON.parse(res);
                    resolve(res);
                } catch (e) {
                    reject();
                }
            });
    }).then(function (res) {
        if (res.token != false) {
            var row = createTableRow([++count, res.uid]);
            var tblResult = $('#tblResult tbody')[0];
            tblResult.appendChild(row);
        }
    }).catch(function () {

    });
}



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

