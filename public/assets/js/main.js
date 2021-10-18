// const { constant } = require("lodash")

/*==================== SHOW MENU ====================*/
const showMenu = (toggleId, navId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId)

    // Validate that variables exist
    if(toggle && nav){
        toggle.addEventListener('click', ()=>{
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu')
        })
    }
}
showMenu('nav-toggle','nav-menu')

/*==================== REMOVE MENU MOBILE ====================*/
const navLink = document.querySelectorAll('.nav__link')

function linkAction(){
    const navMenu = document.getElementById('nav-menu')
    // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/*==================== SCROLL SECTIONS ACTIVE LINK ====================*/
// const sections = document.querySelectorAll('section[id]')

// function scrollActive(){
//     const scrollY = window.pageYOffset

//     sections.forEach(current =>{
//         const sectionHeight = current.offsetHeight
//         const sectionTop = current.offsetTop - 50;
//         sectionId = current.getAttribute('id')

//         if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
//             document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active-link')
//         }else{
//             document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active-link')
//         }
//     })
// }
// window.addEventListener('scroll', scrollActive)

/*==================== CHANGE BACKGROUND HEADER ====================*/
function scrollHeader(){
    const nav = document.getElementById('header')
    // When the scroll is greater than 200 viewport height, add the scroll-header class to the header tag
    if(this.scrollY >= 200) nav.classList.add('scroll-header'); else nav.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

/*==================== SHOW SCROLL TOP ====================*/
function scrollTop(){
    const scrollTop = document.getElementById('scroll-top');
    // When the scroll is higher than 560 viewport height, add the show-scroll class to the a tag with the scroll-top class
    if(this.scrollY >= 560) scrollTop.classList.add('show-scroll'); else scrollTop.classList.remove('show-scroll')
}
window.addEventListener('scroll', scrollTop)

/*==================== DARK LIGHT THEME ====================*/
const themeButton = document.getElementById('theme-button')
const darkTheme = 'dark-theme'
const iconTheme = 'bx-sun'
// Previously selected topic (if user selected)
const selectedTheme = localStorage.getItem('selected-theme')
const selectedIcon = localStorage.getItem('selected-icon')

// We obtain the current theme that the interface has by validating the dark-theme class
const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'bx-moon' : 'bx-sun'

// We validate if the user previously chose a topic
if (selectedTheme) {
  // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
  document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
  themeButton.classList[selectedIcon === 'bx-moon' ? 'add' : 'remove'](iconTheme)
}


// Activate / deactivate the theme manually with the button
themeButton.addEventListener('click', () => {
    // Add or remove the dark / icon theme
    document.body.classList.toggle(darkTheme)
    themeButton.classList.toggle(iconTheme)
    // We save the theme and the current icon that the user chose
    localStorage.setItem('selected-theme', getCurrentTheme())
    localStorage.setItem('selected-icon', getCurrentIcon())
});

/*==================== SCROLL REVEAL ANIMATION ====================*/
const sr = ScrollReveal({
    origin: 'top',
    distance: '30px',
    duration: 2000,
    reset: true
});

sr.reveal(`.home__data, .home__img,
            .about__data, .about__img,
            .services__content, .menu__content,
            .app__data, .app__img,
            .contact__data, .contact__button,
            .footer__content,.sub_heading,.splide__list,.ebook,.heading,.about_img,
            .about_text,.our-team,.input_animate,.blog`, {
    interval: 200
})


//Splide Slider

document.addEventListener( 'DOMContentLoaded', function () {
	new Splide( '#image-splide', {
        type   : 'loop',
        autoWidth: true,
        // perPage: 3,
        focus  : 'center',
    } ).mount();
} );


// upload profile

function initImageUpload(box) {
    let uploadField = box.querySelector('.image-upload');

    uploadField.addEventListener('change', getFile);

    function getFile(e){
      let file = e.currentTarget.files[0];
      checkType(file);
    }

    function previewImage(file){
      let thumb = box.querySelector('.js--image-preview'),
          reader = new FileReader();

      reader.onload = function() {
        thumb.style.backgroundImage = 'url(' + reader.result + ')';
      }
      reader.readAsDataURL(file);
      thumb.className += ' js--no-default';
    }

    function checkType(file){
      let imageType = /image.*/;
      if (!file.type.match(imageType)) {
        throw 'Datei ist kein Bild';
      } else if (!file){
        throw 'Kein Bild gewählt';
      } else {
        previewImage(file);
      }
    }

  }

  // initialize box-scope
  var boxes = document.querySelectorAll('.box');

  for (let i = 0; i < boxes.length; i++) {
    let box = boxes[i];
    initDropEffect(box);
    initImageUpload(box);
  }



  /// drop-effect
  function initDropEffect(box){
    let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

    // get clickable area for drop effect
    area = box.querySelector('.js--image-preview');
    area.addEventListener('click', fireRipple);

    function fireRipple(e){
      area = e.currentTarget
      // create drop
      if(!drop){
        drop = document.createElement('span');
        drop.className = 'drop';
        this.appendChild(drop);
      }
      // reset animate class
      drop.className = 'drop';

      // calculate dimensions of area (longest side)
      areaWidth = getComputedStyle(this, null).getPropertyValue("width");
      areaHeight = getComputedStyle(this, null).getPropertyValue("height");
      maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

      // set drop dimensions to fill area
      drop.style.width = maxDistance + 'px';
      drop.style.height = maxDistance + 'px';

      // calculate dimensions of drop
      dropWidth = getComputedStyle(this, null).getPropertyValue("width");
      dropHeight = getComputedStyle(this, null).getPropertyValue("height");

      // calculate relative coordinates of click
      // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
      x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
      y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;

      // position drop and animate
      drop.style.top = y + 'px';
      drop.style.left = x + 'px';
      drop.className += ' animate';
      e.stopPropagation();

    }
  }

  function commentEdit(id){
    $.get('/comment/edit/'+id,function(user_cmt){
        $("#edit_id").val(user_cmt.id);
        $('#edit_cmt').val(user_cmt.comment);
        $('#edit_comment').toggle();
    });
}

function commentDelete(id){
   if(confirm('Do you want to delete this record ?')){
       $.ajax({
            url: '/comment/delete/'+id,
            method: 'GET',
            success: function(response){
               $('#cmt_card_'+id).remove();
           }
       })
   }
}



// profile change

$(document).ready(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    // Update Profile

    $("#profile_upload").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
            $.ajax({
                url: '/user/upload_image',
                type: 'POST',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success:
                    function(response){
                        if(response){
                            $('.user_pf').attr('src',response.image);
                            $('#user_profile').attr('src',response.image);
                            $("#profile_image").modal('hide');
                            console.log(response)
                        }
                        }
                    ,
                error:
                    function(response){
                        $('.profile_upload_error').text(`
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        `+response.responseJSON.errors.file+` !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        `);
                    }

            });
    });

    // Change Profile Details

    $("#change_profile_detail").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
            $.ajax({
                url: '/user/change_profile_detail',
                type: 'POST',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success:
                    function(response){
                        if(response){
                            $('.profile_detail h4').text(response.name);
                            $('.profile_detail p').text(response.email);
                            $(this).trigger('reset');
                            $("#edit_user_detail").modal('hide');
                            }
                        // console.log(response)
                        }
                    ,
                error:
                    function(response){
                        $('.profile_detail_error').text(`
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        `+response.responseJSON.errors+` !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        `);
                    }

            });
    });

     // User Add Comment

     $("#comment").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
            $.ajax({
                url: '/user/add-comment',
                type: 'POST',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success:
                    function(response){
                        if(response){
                            $('#add_comment').toggle();
                            $('.cmt_list').append(`
                            <div class="card my-3">
                            <div class="card-body">
                                <div class="card-title d-flex">
                                    <img src="`+response.user_image+`" width="30px" height="30px" style="border-radius: 50%;" alt="Image">
                                    <h6 class="px-3 mt-2">`+response.user.name+`</h6>
                                    <small class="ms-auto">`+response.created_at+`</small>
                                </div>
                                <div class="card-content">
                                    <p class="text-justify">
                                        ` +response.comment+`
                                    </p>
                                </div>
                                <div class="d-flex my-3 justify-content-end">
                                        <a href="javascript:void(0)" class="mx-3" onclick="commentEdit(`+response.id+`)">Edit</a>
                                        <a href="javascript:void(0)" class="text-danger" onclick="commentDelete(`+response.id+`)">Delete</a>
                                </div>
                            </div>
                        </div>
                            `);

                            $('.book_cmt_count').html(`This book have `+response.count+` comments.`);
                            }
                        }
                    ,
                error:
                    function(response){
                        console.log(response.responseJSON.errors)
                    }

            });

    });

         // User Edit Comment

         $("#update_comment").submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
                $.ajax({
                    url: '/user/update-comment',
                    type: 'POST',
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:
                        function(response){
                            if(response){
                                $('#edit_comment').toggle();
                                $('#comment_card_'+response.id).text(response.comment);
                                }
                            }
                        ,
                    error:
                        function(response){
                            console.log(response.responseJSON.errors)
                        }

                });

        });



});


