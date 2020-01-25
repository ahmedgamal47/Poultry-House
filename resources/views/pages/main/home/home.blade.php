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
    })(jQuery);
</script>
@stop