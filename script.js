var bm;


//model k
var k;

function changeView() {
    var signInbox = document.getElementById("signinbox");
    var signUpbox = document.getElementById("signupbox");

    signInbox.classList.toggle("d-none");
    signUpbox.classList.toggle("d-none");
}

function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                document.getElementById("msg").innerHTML = "";
                changeView();
            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    };
    r.open("POST", "signupprocess.php", true);
    r.send(f)
}

function signin() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var remember = document.getElementById("remember");
    //alert(remember.value);
    //alert(remember.checked);
    var f = new FormData();
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("remember", remember.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                swal("Sign In Successfull!", "Welcome To Gaming Tech", "success");
                window.location = "home.php";

            } else if (text == "Invalid details") {
                document.getElementById("msg2").innerHTML = text;

            }
        }
    };
    r.open("POST", "signinprocess.php", true);
    r.send(f);
}

function forgotpassword() {
    var email = document.getElementById("email2");
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                document.getElementById("loadingspin").className = "d-block";
                alert("Verification Code Sent,Please Check Your Email");
                var m = document.getElementById("forgetpasswordmodal");
                bm = new bootstrap.Modal(m);
                bm.show();
                document.getElementById("loadingspin").className = "d-none";
            } else {
                swal(text);
            }
        }
    };
    r.open("GET", "forgotprocess.php?e=" + email.value, true);
    r.send();
}

function showPassword1() {
    var s = document.getElementById("np");
    var sb = document.getElementById("npb");

    if (sb.innerHTML == "Show") {
        s.type = "text";
        sb.innerHTML = "Hide";
    } else {
        s.type = "password";
        sb.innerHTML = "Show";
    }

}

function showPassword2() {
    var s2 = document.getElementById("rnp");
    var sb2 = document.getElementById("rnpb");

    if (sb2.innerHTML == "Show") {
        s2.type = "text";
        sb2.innerHTML = "Hide";
    } else {
        s2.type = "password";
        sb2.innerHTML = "Show";
    }

}

function resetPassword() {
    var e = document.getElementById("email2")
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var form = new FormData();
    form.append("e", e.value);
    form.append("np", np.value);
    form.append("rnp", rnp.value);
    form.append("vc", vc.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                swal("password reset success");
                bm.hide()
            } else {
                swal(text);
            }
        }
    };
    r.open("POST", "resetPassword.php", true);
    r.send(form);
}

function goToAddProduct() {
    window.location = "sellerproductview.php";
}

function changeImage() {
    var image = document.getElementById("imguploader");
    var view = document.getElementById("prev");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

function changeProfileImage() {
    var image = document.getElementById("profileimg");
    var view = document.getElementById("proimg");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}


function addproduct() {
    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");
    var condition;
    if (document.getElementById("Bn").checked) {
        condition = 1;
    } else if (document.getElementById("Usd").checked) {
        condition = 2;
    }
    var colour = document.getElementById("clr").value;

    var qty = document.getElementById("q");
    var price = document.getElementById("cost");
    var deliveryWcolombo = document.getElementById("dwc");
    var deliveryOcolombo = document.getElementById("doc");
    var desciption = document.getElementById("desc");
    var image = document.getElementById("imguploader");

    //alert(category.value);
    //alert(brand.value);
    //alert(model.value);
    //alert(title.value);
    //alert(condition);
    //alert(colour);
    //alert(qty.value);
    //alert(price.value);
    //alert(deliveryWcolombo.value);
    //alert(deliveryOcolombo.value);
    //alert(desciption.value);
    //alert(image.value);

    var form = new FormData();
    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("co", condition);
    form.append("col", colour);
    form.append("qty", qty.value);
    form.append("p", price.value);
    form.append("dwc", deliveryWcolombo.value);
    form.append("doc", deliveryOcolombo.value);
    form.append("desc", desciption.value);
    form.append("img", image.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt = "success") {
                swal("Product Added Successfully").then((value) => {
                    window.location.reload();
                });
            } else {
                swal(text);
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(form);
}

function signout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "so") {
                window.location = "home.php";
            }
        }
    };

    r.open("GET", "signout.php", true);
    r.send();
}

function changeproductview() {
    window.location = "addproduct.php";
}

function changeproductviewrev() {
    window.location = "updateproduct.php";
}

function updateProfile() {
    var fname = document.getElementById("fn");
    var lname = document.getElementById("ln");
    var mobile = document.getElementById("mobile");
    var line01 = document.getElementById("line01");
    var line02 = document.getElementById("line02");
    var city = document.getElementById("city");
    var profileimg = document.getElementById("profileimg");


    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("a1", line01.value);
    form.append("a2", line02.value);
    form.append("c", city.value);
    form.append("i", profileimg.files[0]);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("success");
                window.location.reload();
            } else {
                alert(text);
            }



        }
    };
    r.open("POST", "updateprofileprocess.php", true);
    r.send(form);
    // alert(fname.value);
    // alert(lname.value);
    // alert(mobile.value);
    // alert(line01.value);
    // alert(line02.value);
    // alert(city.value);
    // alert(profileimg.value);
}

function changeStatus(id) {
    var productid = id;
    var statuslabel = document.getElementById("checklabel" + productid);

    if (document.getElementById("check").checked) {
        var status = 0;
    } else {
        status = 1;
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "deactive") {
                statuslabel.innerHTML = "Make Your Product Activate";

            } else if (txt == "active") {
                statuslabel.innerHTML = "Make Your Product Deactivate";

            }

        }
    };
    r.open("GET", "statusChangeProcess.php?p=" + productid, true);
    r.send();
}

var dpm;

function deleteModel(id) {
    var dm = document.getElementById('deleteModel' + id);
    var dpm = new bootstrap.Modal(dm);
    dpm.show();
}

function deleteProduct(id) {
    var productid = id;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "Product Deleted") {

                swal(t);
                window.location.reload();

            } else {

                swal("Cannot Delete This Product!!! " + productid + " ,Try Deactivating!")
                    .then((value) => {
                        window.location.reload();
                    });



            }
        }
    };

    request.open("GET", "deleteproduct.php?id=" + productid, true);
    request.send();
}

function addfilters() {
    var search = document.getElementById("s");
    var age;
    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }

    var qty;
    if (document.getElementById("l").checked) {
        qty = 1;
    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }
    var f = new FormData();
    f.append("s", search.value);
    f.append("a", age);
    f.append("q", qty);
    f.append("c", condition);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("box").innerHTML = t;
        }
    };
    r.open("POST", "filterProcess.php", true);
    r.send(f);
    // alert(search.value);
    // alert(age);
    // alert(qty);
    // alert(condition);

}

function searchtoupdate() {
    var id = document.getElementById("searchid").value;
    var title = document.getElementById("ti");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            var object = JSON.parse(text);

            title.value = object["title"];
        }
    };
    r.open("GET", "searchtoupdateprocess.php?id=" + id, true);
    r.send();
}

function sendid(id) {
    var id = id;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            }
        }
    };
    r.open("GET", "sendProductProcess.php?id=" + id, true);
    r.send();

}



function loadmainimg() {
    var pid = id;
    var img = document.getElementById("pimg" + pid).src;
    var mainimg = document.getElementById("mainimg");

    mainimg.style.backgroundImage = "url(" + img + ")";
}
///qty update
function qtyinc(qty) {
    var q = qty
    var input = document.getElementById("qtyinput");
    if (input.value < parseInt(q)) {
        var newvalue = parseInt(input.value) + 1;
        input.value = newvalue.toString();
    } else {
        swal("Maximum Quantity value Reached");
    }
}

function qtydec() {
    var input = document.getElementById("qtyinput");
    if (input.value > 1) {
        var newvalue = parseInt(input.value) - 1;
        input.value = newvalue.toString();
    } else {
        swal("Minimum Quantity Value Reached");
    }

}
///basic search

function basicsearch() {
    var searchText = document.getElementById("basic_search_txt");
    var searchSelect = document.getElementById("basic_search_select");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;

            if (txt == "empty") {
                document.getElementById("searchbox").innerHTML = "No results found:/ ";
            } else {
                document.getElementById("pviewbox").className = "d-none";
                document.getElementById("srviewbox").className = "d-block";
                document.getElementById("searchbox").innerHTML = txt;





            }
        }
    };
    r.open("GET", "basicSearchProcess.php?t=" + searchText.value + "&s=" + searchSelect.value, true);
    r.send();

    // alert(searchText.value);
    // alert(searchSelect.value);
}
//////////////////////////
function addToWatchList(pid) {
    var productid = pid;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
            if (txt == "success") {
                window.location = "watchList.php"
            }

        }
    };
    r.open("GET", "addToWatchlistProcess.php?pid=" + productid, true);
    r.send();
}

function deletefromwatchlist(id) {
    var wid = id;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            alert(text);
            if (text == "success") {
                window.location = "watchlist.php";
            }
        }
    };

    request.open("GET", "removewatchlistprocess.php?id=" + wid, true);
    request.send();
}

function addToCart(id) {
    var q = document.getElementById("qty");
    var pid = id;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var text = r.responseText;
            if (text == "Success") {
                window.location = 'cart.php';
            } else {
                swal(text, {});
                setTimeout(pagereload, 5000);
            }
        }


    };


    r.open("GET", "addToCartProcess.php?qty=" + q.value + "&pid=" + pid, true);
    r.send();




}

function addToCartfromwishlist(id) {
    var q = 1;
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var text = r.responseText;
            if (text == "Success") {
                window.location = 'cart.php';
            } else {
                swal(text, {});
                setTimeout(pagereload, 5000);
            }
        }


    };

    r.open("GET", "addToCartfromwishlist.php?qty=" + q + "&pid=" + pid, true);
    r.send();




}

function pagereload() {

    window.location.reload();

}


function paynow(id) {
    var qty = document.getElementById("qtyinput").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            //  var obj = JSON.parse(text);
            // var mail = obj["email"];
            // var amount = obj["amount"];
            if (text == "1") {
                alert("Please Sign In first");
            } else if (text == "2") {
                alert("Please Update your profile First");
                window.location = "userprofile.php";
            } else {
                var obj = JSON.parse(text);
                var mail = obj["email"];
                var amount = obj["amount"];

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);
                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218032", // Replace your Merchant ID
                    "return_url": "http://localhost/Eshop/singleproductview.php?id=" + id, // Important
                    "cancel_url": "http://localhost/Eshop/singleproductview.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById('payhere-payment').onclick = function(e) {
                    payhere.startPayment(payment);
                };


            }

        }
    };

    r.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
    r.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {
    var orderid = orderId;
    var pid = id;
    var mail = mail;
    var total = amount;
    var pqty = qty;

    var form = new FormData();
    form.append("oid", orderid);
    form.append("pid", pid);
    form.append("email", mail);
    form.append("total", total);
    form.append("pqty", pqty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderid;
            }
        }
    };

    r.open("POST", "saveinvoice.php", true);
    r.send(form);


}
//feedback
function addfeedback(id) {
    var feedmodal = document.getElementById("feedbackModal" + id);
    k = new bootstrap.Modal(feedmodal);
    k.show();
}
//save feedback

function saveFeedbck(id) {

    var pid = id;
    var feedtxt = document.getElementById("feedtxt").value;

    var f = new FormData();
    f.append("i", pid);
    f.append("ft", feedtxt);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                k.hide();
            } else {
                alert(t);
            }
        }
    };
    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}


function gotocart() {
    window.location = "cart.php";
}

function deletefromCart(id) {
    var cid = id;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "cart.php";
            } else {
                alert(t);
            }
        }
    };
    r.open("GET", "deleteFromCartProcess.php?id=" + cid, true);
    r.send();
}

function blockUser(email) {
    var mail = email;
    var blockbtn = document.getElementById("blockbtn");

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t == "2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "userBlockProcess.php", true);
    r.send(f);
}

function searchUser() {
    var text = document.getElementById("searchTxt");
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "No results") {
                alert(t);
            } else {
                document.getElementById("box").innerHTML = t;
                document.getElementById("view").className = "d-none";
            }
        }

    };


    r.open("GET", "searchUser.php?stext=" + text.value, true);
    r.send();
}

function advancedSearch(x) {
    var key = document.getElementById("k").value;
    var cat = document.getElementById("c").value;
    var brand = document.getElementById("b").value;
    var model = document.getElementById("m").value;
    var condition = document.getElementById("con").value;
    var color = document.getElementById("clr").value;
    var pfrom = document.getElementById("pf").value;
    var pto = document.getElementById("pt").value;


    var form = new FormData();
    form.append("page", x);
    form.append("k", key);
    form.append("c", cat);
    form.append("b", brand);
    form.append("m", model);
    form.append("co", condition);
    form.append("clr", color);
    form.append("pf", pfrom);
    form.append("pt", pto);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("pv").innerHTML = text;
            // alert(text);
        }
    };
    r.open("POST", "advancedSearchProcess.php", true);
    r.send(form);
}

function adminverification() {
    var email = document.getElementById("e").value;
    var f = new FormData();
    f.append("e", email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {

                var Verification = document.getElementById("verificationmodal");
                k = new bootstrap.Modal(Verification);
                k.show();

            } else {
                alert(t);
            }
        }

    };


    r.open("POST", "adminverificationprocess.php", true);
    r.send(f);
}

function verify() {

    var vcode = document.getElementById("v").value;

    var f = new FormData();
    f.append("v", vcode);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t)
            }
        }

    };


    r.open("POST", "verifyprocess.php", true);
    r.send(f);


}

function detailsmodel(id) {
    alert(id);
}

function updateprocess(id) {
    var pid = id
    var upti = document.getElementById("ti").value;
    var upq = document.getElementById("qty").value;
    var upcost = document.getElementById("upcost").value;
    var updwc = document.getElementById("dwc").value;
    var updoc = document.getElementById("doc").value;
    var updesc = document.getElementById("desc").value;
    var img = document.getElementById("upimguploader");

    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("pid", pid);
    form.append("upti", upti);
    form.append("upq", upq);
    form.append("upcost", upcost);
    form.append("updwc", updwc);
    form.append("updoc", updoc);
    form.append("updesc", updesc);
    form.append("img", img.files[0]);


    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                swal("Product Updated Successfully").then((value) => {
                    window.location.reload();
                });
            } else {
                swal(text);
            }
        }

    };
    r.open("POST", "productupdateprocess.php", true);
    r.send(form);

}

function changeupdateImage() {
    var image = document.getElementById("upimguploader");
    var view = document.getElementById("prev");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

function sendmsg(to) {
    var msg = document.getElementById("msg");

    var form = new FormData();
    form.append("msg", msg.value);
    form.append("to", to);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt = "success") {
                msg.value = "";
                reloadmsg(to);
            }
        }
    };

    r.open("POST", "savemsg.php", true);
    r.send(form);


}

function reloadmsg(to) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("cht").innerHTML = t;
        }
    };

    r.open("GET", "reloadmsg.php?to=" + to, true);
    r.send();


}

function msgrefresher(toem) {

    setInterval(reloadmsg, 1000, toem);
    setInterval(reloadrecent, 2500);


}

function reloadrecent() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Hello") {

            }

        }
    };
    r.open("GET", "reloadrecent.php", true);
    r.send();
}

function dailysellings() {

    var from = document.getElementById("fromdate").value;
    var to = document.getElementById("todate").value;
    var link = document.getElementById("historylink");

    link.href = "sellinghistory.php?f=" + from + "&t=" + to;

}

function viewmsgmodal(uem) {
    var pop = new bootstrap.Modal(document.getElementById("msgModal" + uem));
    pop.show();
    // alert(uem);
}

function reloadAdminSideMsgModal(toem) {

    var ADMmsg_view_box = document.getElementById("ADMmsg_view_box" + toem);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            ADMmsg_view_box.innerHTML = t;
        }
    };

    r.open("GET", "reloadAdminSideMsgModalPro.php?to=" + toem, true);
    r.send();
}

function ADMSidesendMessage(usem) {

    var Adsidemsgtxt = document.getElementById("Adsidemsgtxt" + usem);

    // alert(Adsidemsgtxt.value);

    var form = new FormData();
    form.append("to", usem);
    form.append("msg", Adsidemsgtxt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                Adsidemsgtxt.value = "";
                reloadAdminSideMsgModal(usem);
            }
        }
    };

    r.open("POST", "AdmnSideSendMsgProcess.php", true);
    r.send(form);

}
var singlevwMod;

function singleviewMod(pid) {
    singlevwMod = new bootstrap.Modal(document.getElementById("singleproductvw" + pid));
    singlevwMod.show();
}


var addCat;

function addNewCategory() {
    addCat = new bootstrap.Modal(document.getElementById("addCatMod"));
    addCat.show();
}


function blockProductsAl(pid) {

    var blockbtn = document.getElementById("blockbtn" + pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "blocked") {
                // window.location.reload();
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t == "unblocked") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "blockProducts.php?pid=" + pid, true);
    r.send();
}

function saveCategory() {
    var cattxt = document.getElementById("cattxt");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
                addCat.hide();
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "addNewCategoryprocess.php?c=" + cattxt.value, true);
    r.send();
}

function searchinsellingHistory() {


    var Search = document.getElementById("Searchcode").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "No records found !") {

            } else {
                document.getElementById("bdn").className = "d-none";
                document.getElementById("bodypart").innerHTML = t;
            }
        }

    };
    r.open("GET", "sellsearchpro.php?s=" + Search, true);
    r.send();



}


function clientSidesendMessage() {


    var cm = document.getElementById("clientsidemsgtxt");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                cm.value = "";
                reloadclientmessage();

            } else {
                alert(text);
            }
        }

    };



    r.open("GET", "clientmsgsave.php?cm=" + cm.value, true);
    r.send();




}

function reloadclientmessage() {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;

            document.getElementById("usrmsg_view_box").innerHTML = text;
        }
    };
    r.open("GET", "clientreloadmessage.php", true);
    r.send();

}

function loopmsgs() {
    setInterval(reloadclientmessage(), 10000);
}

function seeall(id) {

    var i = document.getElementById("itembox" + id);



    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            i.innerHTML = t;
            document.getElementById("sall" + id).className = "d-none";
            document.getElementById("call" + id).className = "d-inline-block";
        }


    };
    r.open("GET", "seeallprocess.php?id=" + id, true);
    r.send();


}

function collapse(id) {

    var i = document.getElementById("itembox" + id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            i.innerHTML = t;
            document.getElementById("sall" + id).className = "d-inline-block";
            document.getElementById("call" + id).className = "d-none";

        }

    };
    r.open("GET", "collapseprocess.php?id=" + id, true);
    r.send();

}

function clearfilters() {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("filters").innerHTML = text;
        }

    };
    r.open("GET", "clearfilterproecess.php", true)
    r.send();

}

function selectmodel() {
    var br = document.getElementById("br").value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("mo").innerHTML = text;
        }

    };

    r.open("GET", "selectmodelprocess.php?br=" + br, true);
    r.send();

}

function gotoIndex() {
    window.location = "index.php";
}

function checkoutall() {




    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Please Sign In") {

            } else if (text == "No product found in Cart") {

            } else if (text == "Please Update Your Profile") {

            } else if (text == "User is Banned") {

            } else {
                var obj = JSON.parse(text);
                var email = obj["e"];
                var mobile = obj["m"];
                var fname = obj["fn"];
                var lname = obj["ln"];
                var amount = obj["amount"];

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    //Note: validate the payment and show success or failure page to the customer
                    checkoutInvoice(orderId);
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218032", // Replace your Merchant ID
                    "return_url": "http://localhost/Eshop/singleproductview.php", // Important
                    "cancel_url": "http://localhost/Eshop/singleproductview.php", // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["oid"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": fname,
                    "last_name": lname,
                    "email": email,
                    "phone": mobile,
                    "address": obj["addrs"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["addrs"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById('payhere-payment').onclick = function(e) {
                    payhere.startPayment(payment);
                };







            }





        }
















    };




    r.open("GET", "checkoutprocess.php", true);
    r.send();



}

function checkoutInvoice(orderId) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            window.location = "invoice.php?id=" + orderId;

        }
    };



    r.open("GET", "checkoutInvoice.php?oid=" + orderId, true);
    r.send();



}



function setdist() {
    var cid = document.getElementById("city").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "1") {

            } else if (txt == "3") {

            } else {

                document.getElementById("reigonbox").innerHTML = txt;


            }
        }

    };
    r.open("GET", "setdistform.php?cid=" + cid, true);
    r.send();




}

function closefcanvas() {

    var fk = document.getElementById("filcanvas");
    fk.style.width = "0px";
    fk.style.transitionDuration = "200ms";
    var box = document.getElementById("box");
    box.className = "col-md-10 offset-md-1 mt-3 mb-3 main-background rounded";
    box.style.transitionDuration = "200ms";
    setTimeout(function() {
        window.location.reload();
    }, 200);


}

function openfcanvas() {

    var fk = document.getElementById("filcanvas");
    fk.style.width = "400px";
    fk.style.transitionDuration = "200ms";
    var box = document.getElementById("box");
    box.className = "col-md-8 offset-md-3 mt-3 mb-3 main-background rounded";
    box.style.transitionDuration = "200ms";

}

function printDiv() {
    var divContents = document.getElementById("GFG").innerHTML;
    var a = window.open('', '', 'height=500, width=500');
    a.document.write('<html>');
    a.document.write('<body > <h1>Div contents are <br>');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("GFG").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;


}

function changeqty(cid) {

    var cq = document.getElementById("cqty" + cid);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location.reload();
            } else {
                cq.value = "";
                window.location.reload();
            }
        }

    };
    r.open("GET", "cartqtyset.php?cqty=" + cq.value + "&cid=" + cid, true);
    r.send();
}

function dlthis(iid) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "dlted") {
                swal({
                    icon: "success",
                    text: "record deleted",

                }).then((value) => {
                    window.location.reload();
                });
            } else {
                swal(txt);
            }
        }

    };
    r.open("GET", "dltitemhis.php?iid=" + iid, true);
    r.send();
}

function clearallrec() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var txt = r.responseText;
            if (txt == "Records Cleared") {
                swal({
                    icon: "success",
                    text: "All Records Cleared",
                }).then((value) => {
                    window.location.reload();
                })
            }

        }

    };
    r.open("GET", "clearpurchhist.php", true);
    r.send();
}

function addbrand() {
    var bd = document.getElementById("bd").value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var txt = r.responseText;
            swal(txt).then((value) => {
                window.location.reload();
            });

        }

    };
    r.open("GET", "addbrandprocess.php?bd=" + bd, true);
    r.send()
}

function addmodel() {
    var mod = document.getElementById("mod1").value;
    var brsel = document.getElementById("brsel").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var txt = r.responseText;
            swal(txt).then((value) => {
                window.location.reload();
            });
        }

    };
    r.open("GET", "addmodelprocess.php?m=" + mod + "&brsel=" + brsel, true);
    r.send();
}