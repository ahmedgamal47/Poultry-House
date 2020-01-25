@extends('layout.main')

@section('title', 'الصفحة الرئيسية')

@section('content')
    @include('pages.main.home.intro')
    @include('pages.main.home.products')
    @include('pages.main.home.about')
    @include('pages.main.home.clinic-soon')
    @include('pages.main.home.users')
@stop

@section('script')
<script>
    (function ($) {
        'use strict';

        // Instantiate the Bootstrap carousel
        $('.multi-item-carousel').carousel({
            interval: false
        });

        // for every slide in carousel, copy the next slide's item in the slide.
        // Do the same for the next, next item.
        $('.multi-item-carousel .item').each(function () {
            var curr = $(this);
            for(var i = 0; i < Math.min(3, $(this).parent().children().size() - 1); i++) {
                var next = curr.prev();
                if (!next.length) {
                    next = $(this).siblings(':last');
                }
                next.children(':first-child').clone().appendTo($(this));
                curr = next;
            }
        });
    })(jQuery);

    (function($) {
        'use strict';

        $(document).on('show.bs.tab', '.nav-tabs-responsive [data-toggle="tab"]', function(e) {
            var $target = $(e.target);
            var $tabs = $target.closest('.nav-tabs-responsive');
            var $current = $target.closest('li');
            var $parent = $current.closest('li.dropdown');
            $current = $parent.length > 0 ? $parent : $current;
            var $next = $current.next();
            var $prev = $current.prev();
            var updateDropdownMenu = function($el, position){
                $el.find('.dropdown-menu')
                    .removeClass('pull-xs-left pull-xs-center pull-xs-right')
                    .addClass( 'pull-xs-' + position );
            };

            $tabs.find('>li').removeClass('next prev');
            $prev.addClass('prev');
            $next.addClass('next');

            updateDropdownMenu( $prev, 'left' );
            updateDropdownMenu( $current, 'center' );
            updateDropdownMenu( $next, 'right' );
        });

        $('.slick-responsive').slick({
            rtl: true,
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.slick-responsive').on('afterChange', function(event, slick, currentSlide, nextSlide){
            //var currentSlide = $('.slick-responsive').slick('slickCurrentSlide');
            //var currentSlide = $(this.$slides.get(index)).data('caption');
            var CurrentSlideDom=$(slick.$slides.get(currentSlide));
            console.log(CurrentSlideDom);
            $( ".cat-wrapper").each(function(){
                $(this).removeClass('active');
            });
            $(CurrentSlideDom).find('.cat-wrapper').addClass('active').find('a').tab('show');
        });

        $( ".cat-wrapper" ).click(function() {
            $( ".cat-wrapper").each(function(){
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            $(this).find('a').tab('show');
        });


        new WOW().init();


    })(jQuery);
</script>
@stop