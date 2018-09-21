<?php
    if (isset($this->session->userdata['logged_in'])) {
        if($this->session->userdata['account_type'] == 'student'){
            $first_name = ($this->session->userdata['first_name']);
            $username = ($this->session->userdata['username']);
            $email = ($this->session->userdata['email']);
            $profile_pic = ($this->session->userdata['profilepic']);
        }
        if($this->session->userdata['account_type'] == 'admin'){
            $username = ($this->session->userdata['username']);
            $admin_name = ($this->session->userdata['admin_name']);
        }
        if($this->session->userdata['account_type'] == 'org'){
            $nsacronym = ($this->session->userdata['nsacronym']);
            $acronym = ($this->session->userdata['acronym']);
            $email = ($this->session->userdata['email']);
            $org_logo = ($this->session->userdata['org_logo']);
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>UP Organizations</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/my-login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/material-search.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/org.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/stud.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <style type="text/css">
        body {
            background-image: url(<?php echo base_url();
            ?>img/BG.jpg);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            margin-left: 0px;
            margin-right: 0px;
        }

        .cookiealert {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            margin: 0 !important;
            z-index: 999;
            opacity: 0;
            border-radius: 0;
            background: #212327 url("<?php echo base_url();?>img/cubes.png");
            transform: translateY(100%);
            transition: all 500ms ease-out;
            color: #ecf0f1;
        }

        .cookiealert.show {
            opacity: 1;
            transform: translateY(0%);
            transition-delay: 1000ms;
        }

        .cookiealert a {
            text-decoration: underline
        }

        .cookiealert .acceptcookies {
            margin-left: 10px;
            vertical-align: baseline;
        }

        .content {
            width: 80%;
            margin: 0 auto;
            margin-top: 50px;
        }

        .tt-dropdown-menu {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }

        .search-org-input {
  font-family: 'Roboto';
  padding: 5px;
  border: 1px solid transparent;
  box-shadow: 0 0 0 #ddd;
  transition: all 300ms ease-out;
  color: #999;
  font-size: 18px;
  width: 20em;
  border-radius: 4px;
}
.search-org-input:focus {
  border-color: #ddd;
  outline: none;
  box-shadow: 0 0 10px #ddd;
}

.cf:after {
  content: "";
  display: table;
  clear: both;
}

.autocomplete {
    position: relative;
}

.search-org-list {
  position: absolute;
  list-style-type: none;
  background: #fff;
  width: 350px;
  margin-top: 4px;
  box-shadow: 0 0 10px #ddd;
  transition: all .1s ease-out;
  transform: scale(1) translateY(0);
  transform-origin: center center;
}
.search-org-list.hide-list {
  opacity: 0;
  transform: scale(0.875) translateY(-12px);
}
.search-org-list .list-item .name,
.search-org-list .list-item .title {
  display: block;
}
.search-org-list .list-item .name {
  color: #f06;
  padding-bottom: 5px;
}
.search-org-list .list-item .title {
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.search-org-list .list-item img {
  height: 48px;
  vertical-align: top;
  float: left;
  padding-right: 10px;
}
.search-org-list .list-item a {
  display: block;
  padding: 1em;
  color: #999;
  text-decoration: none;
  transition: all 100ms ease;
}
.search-org-list .list-item:hover a, .search-org-list .list-item.highlight a {
  background: #dddde4;
  color: #333;
}
    </style>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-xl navbar-dark" id='nav-bar'>
        <img src="<?php echo base_url();?>img/UP Logo.png" width="35px" class="img-fluid">
        <a class="navbar-brand" href="<?php echo base_url();?>login">
            <?php if (!isset($this->session->userdata['logged_in'])) 
                echo "University of the Philippines Manila";
                else echo "Accreditation System";
                ?>
        </a>

        </button>
        <div class="collapse navbar-collapse justify-content-end" id="nav-content">
            <ul class="navbar-nav">
                <?php
         if(isset($_SESSION['logged_in']) == TRUE){ 
            if($this->session->userdata['account_type'] == 'student'){
                echo "<div id='loggedInAs'>
                logged in as: <a>".$email."</a>
                </div>
                <div class='autocomplete' style='margin-right: 100px !important'>
                <input class='search-org-input' name='org' style='width: 350px;'placeholder='Search for Organization' />
                <ul class='search-org-list'></ul>
                </div>
                <li class='nav-item'>
                <a class='nav-link' href='".base_url()."student/".$username."'><img style='margin-right: 2px; border-radius: 50%;' width='25' src='".base_url().'assets/student/profile_pic/'.$profile_pic.'?'.rand(1, 1000)."'> ".$first_name."</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='#' data-toggle='modal' data-target='#changestudentpassword'>Change Password</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='".base_url()."logout'>Log Out</a>
                </li>";
            }
            if($this->session->userdata['account_type'] == 'org'){
                echo "<div id='loggedInAs'>
                logged in as: <a>".$email."</a>
                </div>
                <li class='nav-item'>
                <a class='nav-link' href='".base_url()."org/".$nsacronym."'><img style='margin-right: 2px; border-radius: 50%;' width='25' src='".base_url().'assets/org/logo/'.$org_logo.'?'.rand(1, 100)."'> ".$acronym."</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='#' data-toggle='modal' data-target='#changeorgpassword'>Change Password</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='".base_url()."logout'>Log Out</a>
                </li>";
            }
            if($this->session->userdata['account_type'] == 'admin'){
                echo "<li class='nav-item'>
                </li>
                <a class='nav-link' href='".base_url()."admin/".$username."'>".$admin_name."</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='#' data-toggle='modal' data-target='#changeadminpassword'>Change Password</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' href='".base_url()."logout'>Log Out</a>
                </li>";
            }
         }
         else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='".base_url()."login'>Login</a>
            </li>";
         }
         ?>
            </ul>
    </nav>
    <script src="<?php echo base_url();?>js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/my-login.js"></script>
    <script src="<?php echo base_url();?>js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url();?>js/multi-step-modal.js"></script>
    <script src="<?php echo base_url();?>js/real-time-search.js"></script>
    <script src="<?php echo base_url();?>js/sweetalert.js"></script>
    <script src="<?php echo base_url();?>js/sweetalert.min.js"></script>
    <script src="<?php echo base_url();?>js/registerOrg.js"></script>
    <script src="<?php echo base_url();?>js/popper.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.26.0/babel.min.js"></script>
    <script type="text/babel">
        function getKeyByValue(obj, value) {
    return Object.keys(obj).find(key => obj[key] === value);
}

function objectByString(obj, str) {
    return str.split('.').reduce(function(prev, curr) {
            return prev ? prev[curr] : undefined
        }, obj || self)
}

const autocomplete = (function() {
    let keyCodes = {
        'ARROW_DOWN': 40,
        'ARROW_UP': 38,
        'TAB': 9,
        'ENTER': 13,
        'ESC': 27
    };
    
    const updateResults = (settings) => {
        let { userValue, data, filterBy } = settings;
        
        let searchTextClean = userValue.toLowerCase();
        let searchWords = searchTextClean.split(' ');
        
        let filteredItems = data.filter((item) => {
            let itemString = item;
            
            if (typeof itemString == 'object') {
                itemString = objectByString(item, filterBy);
            }
            
            let itemValue = itemString.toLowerCase();

            return searchWords.every((word) => itemValue.includes(word));
        });
        
        const results = filteredItems.map(item => settings.item(item));
        let resultsContainer = settings.resultsContainer;
        
        resultsContainer.innerHTML = '';
        
        if (!results.length) {
            return resultsContainer.classList.add('hide-list');
        }
        
        resultsContainer.classList.remove('hide-list');
        
        results.forEach(item => resultsContainer.innerHTML += item);
        
        return resultsContainer;
    }
    
    const incrementHighlightedItem = (action, resultItems, activeItem, activeIndex) => {
        if (
            (resultItems.length == (activeIndex + 1) && action == 'ARROW_DOWN') ||
            (activeIndex == 0 && action == 'ARROW_UP')
           ) {
            return true;
        }
        
        let newIndex = action == 'ARROW_UP' ? activeIndex - 1 : activeIndex + 1;
        
        activeItem.classList.remove('highlight');
        
        return resultItems[newIndex].classList.add('highlight');
    };
    
    const handleInputEvents = (e, settings) => {
        if (e.target.value.length < 1) {
            return settings.resultsContainer.classList.add('hide-list');
        }
        
        let action = getKeyByValue(keyCodes, e.keyCode);
        
        settings.resultsContainer.classList.remove('hide-list');
        settings.userValue = e.target.value;
        
        let resultItems = Array.from(settings.resultsContainer.children);
        let activeItem = false;
        
        if (resultItems.length) {
            activeItem = resultItems.filter(item => item.classList.contains('highlight'))[0];
        }
        
        switch (action) {
            case 'TAB':
            case 'ARROW_UP':
            case 'ARROW_DOWN':
                if (!activeItem) {
                    return resultItems[0].classList.add('highlight');
                }
                
                let activeIndex = resultItems.indexOf(activeItem);

                return incrementHighlightedItem(action, resultItems, activeItem, activeIndex);

                break;
                
            case 'ESC':
                settings.resultsContainer.innerHTML = '';
                settings.resultsContainer.classList.add('hide-list');
                
                return false;
                
                break;
                
            case 'ENTER':
                if (!activeItem) {
                    activeItem = resultItems[0];    
                }
                
                let anchor = activeItem.tagName == 'a' ? activeItem : activeItem.querySelector('a');
                
                return anchor.click();
                
                break;
                
            default:
                return updateResults(settings);
        }   
    }
    
    const render = (item, settings) => {
        const input = item.querySelector('.search-org-input');
        const list = item.querySelector('.search-org-list');
        
        settings.resultsContainer = list;
        settings.resultsContainer.classList.add('hide-list');
        
        input.addEventListener('keyup', (e) => (
            handleInputEvents(e, settings)
        ));
        
        input.addEventListener('focusin', (e) => ( 
            handleInputEvents(e, settings) 
        ));
        
        input.addEventListener('focusout', (e) => (
            settings.resultsContainer.classList.add('hide-list')
        ));
    };
    
    return (args = {}) => {
        let settings = Object.assign({}, {
            'element': [],
            'data': {},
            'filterBy': 'title',
            'item': function(title = {}) {
                return (
                    '<li class="list-item">' + 
                        '<a href="http://google.com">' + title + '</a>' +
                    '</li>'
                );
            }
        }, args);
        
        return settings.element.forEach((item) => render(item, settings));
    };
}());

$('.search-org-input').keyup(function(){
    var search = $('.search-org-input').val();
    $.ajax({
	      type:"post",
	      url:"<?php echo base_url(); ?>student/search",
	      cache: false,
	      data:{query: search},
	      dataType: 'json',
	      async: false,
	      success:function(result){
            let sampleData = result;
            let test = new autocomplete({
            element: document.querySelectorAll('.autocomplete'),
            data: sampleData,
            filterBy: 'acronym',
            item: function(item) {
                var nsacronym = item.acronym.replace(/\s/g, '');
                return (
                    '<li class="list-item">' + 
                        '<a href="<?php echo base_url(); ?>org/'+ nsacronym +'" class="cf">' + 
                            '<img src="<?php echo base_url(); ?>assets/org/logo/'+ item.org_logo +'<?php echo '?'.rand(1,100); ?>" />' +
                            '<span class="name">' + item.org_name+ '</span>' +
                            '<span class="title">' + item.acronym + '</span>' +
                        '</a>' +
                    '</li>'
                );
            }
        });
	      }});
});
    </script>
    <script>
//       var states = new Bloodhound({
//   datumTokenizer: Bloodhound.tokenizers.whitespace,
//   queryTokenizer: Bloodhound.tokenizers.whitespace,
//   // `states` is an array of state names defined in "The Basics"
//   local: ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
//   'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
//   'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
//   'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
//   'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
//   'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
//   'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
//   'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
//   'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
// ]
// });

// $('#search-org-box .search-org-input').typeahead({
//   hint: true,
//   highlight: true,
//   minLength: 1
// },
// {
//   name: 'states',
//   source: states
// });
                $(document).on({
                ajaxStart: function(){
        $('.loadingscreen').show();
    },
    ajaxStop: function(){
            //setTimeout(function(){
                $('.loadingscreen').hide(); 
            //}, 500);
            
    }
  });
            $(window).scroll(function(){
                if ($(this).scrollTop() > 50){
                    $('#nav-bar').addClass('opaque');
                }
                else{
                    $('#nav-bar').removeClass('opaque');
                }
            });
            (function () {
    "use strict";

    var cookieAlert = document.querySelector(".cookiealert");
    var acceptCookies = document.querySelector(".acceptcookies");
    cookieAlert.offsetHeight;

    if (!getCookie("acceptCookies")) {
        cookieAlert.classList.add("show");
    }

    acceptCookies.addEventListener("click", function () {
        setCookie("acceptCookies", true, 60);
        cookieAlert.classList.remove("show");
    });
})();

// Cookie functions stolen from w3schools
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}




        </script>
    <div class="alert alert-dismissible text-center cookiealert" role="alert">
        <div class="cookiealert-container">
            <b>Do you like cookies?</b> &#x1F36A; We use cookies to ensure you get the best experience on our website.

            <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
                I agree
            </button>
        </div>
    </div>
</body>


</html>