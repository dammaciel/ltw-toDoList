function visibleCreateAcc() {
    $("#createAcc-form").show();
}

function exitCreateAcc() {
    $("#createAcc-form").hide();
}

function visibleLogin() {
    $("#login-form").show();
}

function exitLogin() {
    $("#login-form").hide();
}

function visibleCreateList() {
    $("#createList-form").show();
}

function exitCreateList() {
    $("#createList-form").hide();
}

function visibleCreateItem() {
    $("#createItem-form").show();
}

function exitCreateItem() {
    $("#createItem-form").hide();
}

function listOrItemCheck() {
    if(!document.getElementById('searchUser').checked) {
        document.getElementById('ifAny').style.display = 'block';
        document.getElementById('ifItems').style.display = 'block';
        document.getElementById('ifUsers').style.display = 'none';
        if (document.getElementById('searchList').checked) {
            document.getElementById('ifAny').style.display = 'block';
            document.getElementById('ifLists').style.display = 'block';
            document.getElementById('ifUsers').style.display = 'none';
        } else {
            document.getElementById('ifLists').style.display = 'none';
        }
    }else{
        document.getElementById('ifAny').style.display = 'block';
        document.getElementById('ifItems').style.display = 'none';
        document.getElementById('ifUsers').style.display = 'block';
    }
}

function goBack() {
    window.history.back();
}

