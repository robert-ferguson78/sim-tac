jQuery(document).ready(function($) {
    // Toggle the hamburger menu
    $(".navbarmenu").on('click', function() {
        $(".navbarmenu").toggleClass("change");
        $("header .logo").toggleClass("sided");
        $(".main_container").toggleClass("blurred");
        $("header .rightbtn").toggleClass("active");
        $("header nav").toggleClass("active");
        $('.mobile-overlay').toggleClass('active');
        $("body").toggleClass("overflow-hidden");
    });

    // Close the menu when clicking on the overlay
    $('.mobile-overlay').on('click', function () {
        $('.mobile-overlay').removeClass('active');
        $("header nav").removeClass("active");
        $(".navbarmenu").removeClass("change");
        $("header .rightbtn").removeClass("active");
        $("header .logo").removeClass("sided");
        $(".main_container").removeClass("blurred");
        $("body").removeClass("overflow-hidden");
    });

    // Function to append submenu toggle arrows
    function appendSubmenuToggles() {
        if (window.innerWidth <= 1200) {
            $('header .container nav > ul > li.menu-item-has-children > a').each(function() {
                if ($(this).find('.submenu-toggle').length === 0) {
                    $(this).append('<span class="submenu-toggle">+</span>');
                }
            });
        }
    }

    // Append submenu toggle arrows on initial load and window resize
    appendSubmenuToggles();
    $(window).on('resize', function() {
        appendSubmenuToggles();
    });

    // Toggle submenu visibility
    $(document).on('click', 'header .container nav ul li.menu-item-has-children a span.submenu-toggle', function(event) {
        event.preventDefault();
        $(this).toggleClass("open");
        if ($(this).parent().parent('.menu-item-has-children').children('.sub-menu').is(':visible') == true) {
            $(this).parent().parent('.menu-item-has-children').children('.sub-menu').slideUp(200);
            $(this).text('+');
        } else {
            $(this).parent().parent('.menu-item-has-children').children('.sub-menu').slideDown(200);
            $(this).text('-');
        }
    });

    // Video popup functionality
    $('body').on('click', '.video-trigger', function() {
        var videoId = $(this).data('video-id');
        var iframe = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0&loop=1&playlist=' + videoId + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        $('.video-container').html(iframe);
        $('.video-modal').fadeIn();
    });

    $('body').on('click', '.close-modal', function() {
        $('.video-container').empty();
        $('.video-modal').fadeOut();
    });

    // Accordion functionality
    $('.faq-question').on('click', function() {
        var $item = $(this).parent();
        $item.toggleClass('active');
        var $answer = $item.find('.faq-answer');
        
        if ($item.hasClass('active')) {
            $answer.css({
                'padding-top': '15px',
                'padding-bottom': '15px'
            });

            var scrollHeight = $answer.prop('scrollHeight');
            var totalHeight = scrollHeight + 30;

            $answer.css('max-height', totalHeight + 'px');
        } else {
            $answer.css({
                'max-height': '0',
                'padding-top': '0',
                'padding-bottom': '0'
            });
        }
    });

    // Filter functionality
    var selectIds = {};
    $('.selectiteme').change(function() {
        var selectedText = $(this).find(":selected").text().trim();
        var selectId = $(this).attr('id');

        selectIds[selectId] = selectId;

        $('.selected-option[data-id='+ selectId +']').remove();

        if (selectedText !== "") {
            $('.activetaginner').append('<div class="selected-option" data-id='+ selectId +'>' + selectedText + '<span class="close"></span></div>');
            $('.filtersgroupwrapper').css("display","flex");
        }
         
        if (selectId == 'categorySelect') {
            $("#cat_id").val($(this).val());
        } else {
            $("#cont_type_id").val($(this).val());
        }

        ajax_filter($("#cat_id").val(), $("#cont_type_id").val(), $("#search_id").val());
    });

    $(document).on('click', '.close', function() {
        $(this).parent().remove();
        var currentselector = $(this).parent('div').attr('data-id');
        if (currentselector == 'categorySelect') {
            $('#categorySelect').val('');
            $("#cat_id").val('');
        } else {
            $('#contenttype').val('');
            $("#cont_type_id").val('');
        }
        if ($(".selected-option").length == 0) {
            $('.filtersgroupwrapper').css("display","none");
        }
        ajax_filter($("#cat_id").val(), $("#cont_type_id").val(), $("#search_id").val());
    });

    $(document).on('click', '.more_filter a', function() {
        var $this = $(this);
        if ($this.text() === "Hide filter") {
            $this.text("More filter");
            $(".blogs_main .filtersblog .filter_type[data-type=select]").slideUp();
        } else {
            $this.text("Hide filter");
            $(".blogs_main .filtersblog .filter_type[data-type=select]").slideDown();
        }
    });

    $(document).on('click', '.resetfilter button', function() {
        $("#cat_id").val('');
        $("#cont_type_id").val('');
        $("#search_id").val('');
        
        ajax_filter($("#cat_id").val(), $("#cont_type_id").val(), $("#search_id").val());
        
        $(".blogs_main .filtersblog .filter_type[data-type=select] select").find('option').prop('selected', false);
        $(".selected-option").remove();
        $(".blogs_main .filtersgroupwrapper").hide();
    });

    $(".collapse_icon").on("click", function() {
        $(this).siblings(".sharing_icon_list").toggleClass("show");
    });

    // Search functionality
    $("#filter-search-id").on("keyup", function(e) {
        var text_val = $(this).val();
        ajax_filter($("#cat_id").val(), $("#cont_type_id").val(), text_val);
    });

    function ajax_filter(catid, typeid, searchval) {
        var filterdata = {
            action: 'filter_data',
            cat_id: catid,
            cont_type: typeid,
            keyword_search: searchval
        };
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: filterdata,
            dataType: 'json',
            success: function(data) {
                var json = JSON.parse(JSON.stringify(data));
                if (json.listing) {
                    $(".card_listed_inner").html('');
                    $(".card_listed_inner").html(json.listing);
                }
            },
        });
    }

    // Initialize GSAP ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // Fade up animation for package items
    gsap.from(".package-icon", {
        scrollTrigger: {
            trigger: ".text-image-video-block",
            start: "top bottom",
            toggleActions: "play none none reverse",
        },
        y: 50,
        opacity: 0,
        duration: 0.8,
        stagger: 0.2
    });
});

let lastScrollTop = 0;
const header = document.getElementById("header");
let timeout;

window.addEventListener("scroll", function() {
    clearTimeout(timeout);
    timeout = setTimeout(function() {
        header.style.top = "0";
    }, 1200);

    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScroll > lastScrollTop) {
        header.style.top = "-143px";
        header.classList.add("scrolled");
    } else {
        header.style.top = "0";
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    if (window.scrollY === 0) {
        header.classList.remove("scrolled");
    } else {
        header.classList.add("scrolled");
    }
}, false);