function runGetToken() {

    var cookie = $('#in_cookie').val().trim();

    var resultElement = $('#tb_result tbody')[0];

    if (cookie.length != 0) {
        $.post("ajax.php", {
            request: "get_token",
            cookie: cookie
        }, function (res) {
            console.log(res);
            try {
                res = JSON.parse(res);
            }catch (e) {
                console.log(e.message);
            }

            ReactDOM.render(
                <Row data={res} />
                , resultElement
            );
        });
    } else {
        alert("Nhập cookie");
    }

}

function runShareGroup() {
    var cookie = $('#in_cookie').val().trim();
    var mess = $('#in_message').val().trim();
    var link = $('#in_link').val().trim();

    var resultElement = $('#tb_result tbody')[0];

    if (cookie.length != 0) {
        $.post(PATH+"/api/share-to-group", {
            request: "get_token",
            cookie: cookie,
            message: mess,
            link: link
        }, function (res) {
            console.log(res);
        });
    } else {
        alert("Nhập cookie");
    }
}




//React Component
const Row = function (props) {
    var style = {
        wordBreak: 'break-all'
    };

    return (
        <tr>
            <td></td>
            <td style={style}>{props.data.token}</td>
            <td>{props.data.ip}</td>
            <td>{props.data.proxy.ip_address + ":" + props.data.proxy.port}</td>
        </tr>
    );
}

