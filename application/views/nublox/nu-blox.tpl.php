<script id="nuBlox-tpl-col" type="text/x-handlebars-template">

    {{#each _children}}
        <div class="nuBlox-col nuBlox-col-{{colSize}}" data-nublox-type="col" data-nublox-param="{{params}}">

            <div class="nuBlox-col-options">
                <span class="nuBlox-col-displaycolumnsize">{{colSize}}</span>/12
                <i class="fa fa-arrow-left" data-nublox-axn="colsize-"></i>
                <i class="fa fa-arrow-right" data-nublox-axn="colsize+"></i>
                <i class="fa fa-cog" data-nublox-axn="settings"></i>
                <i class="fa fa-close" data-nublox-axn="remove"></i>
            </div>

            <div class="nuBlox-col-content nuBlox-sortable">
                {{#each _children}}
                    {{> (partByType) (singleChildrenObj)}}
                {{/each}}
            </div>

            <div class="nuBlox-col-addModule">
                <i class="fa fa-plus" data-nublox-axn="selectModule"></i>
            </div>

        </div>
    {{/each}}

</script>

<script id="nuBlox-tpl-inline" type="text/x-handlebars-template">

    <div class="nuBlox-inline">
        <form class="nuBlox-modal-form">

            <span class="nuBlox-modal-btn" data-nublox-axn="inlineClose"><i class="fa fa-close"></i>Cancel</span>
            <span class="nuBlox-modal-btn" data-nublox-axn="save"><i class="fa fa-check"></i>Save</span>

            {{!-- edit module --}}
            {{#if editModule}}
                {{> (moduleByType) editModule}}
            {{/if}}

        </form>
    </div>

</script>

<script id="nuBlox-tpl-modal" type="text/x-handlebars-template">

    <div class="nuBlox-modal">
        <form class="nuBlox-modal-form">

            <div class="nuBlox-modal-head">
                <div class="nuBlox-modal-head-title">{{title}}</div>
                <div class="nuBlox-modal-head-close" data-nublox-axn="modalClose"><i class="fa fa-close"></i></div>
            </div>

            <div class="nuBlox-modal-content">

                {{!-- settings --}}
                {{#if settings}}
                    {{> settings settings}}
                {{/if}}

                {{!-- edit module --}}
                {{#if editModule}}
                    {{> (moduleByType) editModule}}
                {{/if}}

                {{!-- display available rows --}}
                {{#if addRow}}
                    {{#each addRow}}
                        <div data-nublox-axn-addrow="{{this}}">{{this}}</div>
                    {{/each}}
                {{/if}}

                {{!-- display available modules --}}
                {{#if addModule}}
                    {{#each addModule}}
                        <div data-nublox-axn-addmodule="{{@key}}"><i class="{{icon}}"></i>{{title}}</div>
                    {{/each}}
                {{/if}}

                {{!-- display templates --}}
                {{#if addTemplate}}
                    {{#each addTemplate}}
                        <div data-nublox-axn-addtemplate="{{content}}">{{name}}</div>
                    {{/each}}
                {{/if}}

            </div>

            {{#if foot}}
            <div class="nuBlox-modal-foot">
                <span class="nuBlox-modal-btn" data-nublox-axn="modalClose"><i class="fa fa-close"></i>Cancel</span>
                <span class="nuBlox-modal-btn" data-nublox-axn="save"><i class="fa fa-check"></i>Save</span>
            </div>
            {{/if}}

        </form>
    </div>

</script>

<script id="nuBlox-tpl-module" type="text/x-handlebars-template">

    {{#each _children}}
        <div class="nuBlox-module" data-nublox-type="module" data-nublox-param="{{params}}">

            {{#_module}}
                <div data-nublox-module-param="{{params}}">

                    <div class="nuBlox-module-title">
                        <i class="{{moduleInfo 'icon'}}"></i>
                        {{moduleInfo 'title'}}
                    </div>

                    <div class="nuBlox-module-options">
                        <i class="fa fa-arrows nuBlox-sortable-ico"></i>
                        <i class="fa fa-pencil" data-nublox-axn="editModule"></i>
                        <i class="fa fa-copy" data-nublox-axn="copy"></i>
                        <i class="fa fa-cog" data-nublox-axn="settings"></i>
                        <i class="fa fa-close" data-nublox-axn="remove"></i>
                    </div>

                </div>
            {{/_module}}

        </div>
    {{/each}}

</script>

<script id="nuBlox-tpl-panel" type="text/x-handlebars-template">

    <div id="nuBlox-panel">

        <div class="nuBlox-panel-options">
            <span data-nublox-axn="selectRow">ADD ROW</span> / <span data-nublox-axn="selectTemplate">ADD FROM TEMPLATE</span>
        </div>

        <div class="nuBlox-content nuBlox-sortable">
            {{> row}}
        </div>

        <div id="nuBlox-modal">
            <!-- modal here -->
            <div class="nuBlox-overlay"></div>
        </div>

    </div>

</script>

<script id="nuBlox-tpl-row" type="text/x-handlebars-template">

    {{#each _children}}
        <div class="nuBlox-row" data-nublox-type="row" data-nublox-param="{{params}}">

            <div class="nuBlox-row-options">
                <div class="nuBlox-row-options-left">
                    <i class="fa fa-arrows nuBlox-sortable-ico"></i>
                </div>
                <div class="nuBlox-row-options-right">
                    <i class="fa fa-plus" data-nublox-axn="addCol"></i>
                    <i class="fa fa-copy" data-nublox-axn="copy"></i>
                    <i class="fa fa-cog" data-nublox-axn="settings"></i>
                    <i class="fa fa-close" data-nublox-axn="remove"></i>
                </div>
            </div>

            <div class="nuBlox-row-content">
                {{> col}}
            </div>

            <div class="nuBlox-row-addRow">
                <span data-nublox-axn="selectRow">
                    <i class="fa fa-plus" data-nublox-axn="addCol"></i>
                    add row
                </span>
            </div>

        </div>
    {{/each}}

</script>

<script id="nuBlox-tpl-settings" type="text/x-handlebars-template">

    <div id="nuBlox-settings">

        {{!--<div class="nuBlox-paddingBorderMarginBox">
            <div class="nuBlox-paddingBorderMarginBox-margin"></div>
            <div class="nuBlox-paddingBorderMarginBox-border"></div>
            <div class="nuBlox-paddingBorderMarginBox-padding"></div>
            <div class="nuBlox-paddingBorderMarginBox-margin-txt">Margin</div>
            <div class="nuBlox-paddingBorderMarginBox-padding-txt">Padding</div>
            <div class="nuBlox-paddingBorderMarginBox-margin-input1"></div>
            <div class="nuBlox-paddingBorderMarginBox-margin-input2"></div>
            <div class="nuBlox-paddingBorderMarginBox-margin-input3"></div>
            <div class="nuBlox-paddingBorderMarginBox-margin-input4"></div>
            <div class="nuBlox-paddingBorderMarginBox-padding-input1"></div>
            <div class="nuBlox-paddingBorderMarginBox-padding-input2"></div>
            <div class="nuBlox-paddingBorderMarginBox-padding-input3"></div>
            <div class="nuBlox-paddingBorderMarginBox-padding-input4"></div>
        </div>--}}

        <div class="nuBlox-tab">

            <div class="nuBlox-tab-menu">
                <div data-nublox-tab="1">1</div>
                <div data-nublox-tab="2">2</div>
            </div>

            <div data-nublox-tab="1">

                {{!-- container settings: only for rows --}}
                <div>
                    <input type="radio" name="wrap" value="fluflu" {{#ifCond wrap 'fluflu'}}checked{{/ifCond}}> flu flu
                    <input type="radio" name="wrap" value="flufix" {{#ifCond wrap 'flufix'}}checked{{/ifCond}}> flu fix
                    <input type="radio" name="wrap" value="fixfix" {{#ifCond wrap 'fixfix'}}checked{{/ifCond}}> fix fix
                </div>

                {{!-- responsive settings: only for cols --}}
                <div>
                    <select name="col_xs">
                        <?php for ($i=1; $i <= 12; $i++) { ?>
                            <option value="<?php echo $i; ?>" {{#ifCond col_xs '<?php echo $i; ?>'}}selected{{/ifCond}}><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <select name="col_sm">
                        <?php for ($i=1; $i <= 12; $i++) { ?>
                            <option value="<?php echo $i; ?>" {{#ifCond col_sm '<?php echo $i; ?>'}}selected{{/ifCond}}><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <select name="col_md">
                        <?php for ($i=1; $i <= 12; $i++) { ?>
                            <option value="<?php echo $i; ?>" {{#ifCond col_md '<?php echo $i; ?>'}}selected{{/ifCond}}><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>

                {{!-- margin --}}
                <input type="text" name="margin[]" value="{{#with margin}}{{0}}{{/with}}" placeholder="margin top">
                <input type="text" name="margin[]" value="{{#with margin}}{{1}}{{/with}}" placeholder="margin right">
                <input type="text" name="margin[]" value="{{#with margin}}{{2}}{{/with}}" placeholder="margin bottom">
                <input type="text" name="margin[]" value="{{#with margin}}{{3}}{{/with}}" placeholder="margin left"><br>

                {{!-- padding --}}
                <input type="text" name="padding[]" value="{{#with padding}}{{0}}{{/with}}" placeholder="padding top">
                <input type="text" name="padding[]" value="{{#with padding}}{{1}}{{/with}}" placeholder="padding right">
                <input type="text" name="padding[]" value="{{#with padding}}{{2}}{{/with}}" placeholder="padding bottom">
                <input type="text" name="padding[]" value="{{#with padding}}{{3}}{{/with}}" placeholder="padding left"><br>

                {{!-- border --}}
                <input type="text" name="border[]" value="{{#with border}}{{0}}{{/with}}" placeholder="border top">
                <input type="text" name="border[]" value="{{#with border}}{{1}}{{/with}}" placeholder="border right">
                <input type="text" name="border[]" value="{{#with border}}{{2}}{{/with}}" placeholder="border bottom">
                <input type="text" name="border[]" value="{{#with border}}{{3}}{{/with}}" placeholder="border left">

                {{!-- ID --}}
                <div class="nuBlox-form-input">
                    <label for="nuBlox-form-settings-id">ID:</label>
                    <input id="nuBlox-form-settings-id" type="text" name="id" value="{{id}}" placeholder="id">
                </div>

                {{!-- class --}}
                <div class="nuBlox-form-input">
                    <label for="nuBlox-form-settings-id">Class:</label>
                    <input id="nuBlox-form-settings-id" type="text" name="class" value="{{class}}" placeholder="class">
                </div>

                {{!-- background color --}}
                <div class="nuBlox-form-input">
                    <label for="nuBlox-form-settings-id">Background color:</label>
                    <input id="nuBlox-form-settings-id" type="text" name="background_color" value="{{background_color}}" placeholder="background_color">
                </div>

            </div>

            <div data-nublox-tab="2">

                {{!-- style --}}
                <div class="nuBlox-form-input">
                    <label for="nuBlox-form-settings-id">Style:</label>
                    <input id="nuBlox-form-settings-id" type="text" name="background_color" value="{{background_color}}" placeholder="background_color">
                </div>

            </div>
        </div>





    </div>

</script>

<script id="nuBlox-tpl-module-html" type="text/x-handlebars-template">
    <div data-nublox-module-title="HTML" data-nublox-module-icon="fa fa-code" >

        <textarea name="content" style="width:100%;height:300px">{{content}}</textarea>

    </div>
</script>

<script id="nuBlox-tpl-module-icon" type="text/x-handlebars-template">
    <div data-nublox-module-title="Icon" data-nublox-module-icon="fa fa-lightbulb-o">

        {{!-- main input --}}
        <input type="text" name="icon" value="{{icon}}" class="nuBloxModule_icon_input">

        {{!-- icons list --}}
        <?php $nuBloxModule_icon_iconslist = ['fa-500px', 'fa-adjust', 'fa-adn', 'fa-align-center', 'fa-align-justify', 'fa-align-left', 'fa-align-right', 'fa-amazon', 'fa-ambulance', 'fa-anchor', 'fa-android', 'fa-angellist', 'fa-angle-double-down', 'fa-angle-double-left', 'fa-angle-double-right', 'fa-angle-double-up', 'fa-angle-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-up', 'fa-apple', 'fa-archive', 'fa-area-chart', 'fa-arrow-circle-down', 'fa-arrow-circle-left', 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-left', 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-up', 'fa-arrow-circle-right', 'fa-arrow-circle-up', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-arrows', 'fa-arrows-alt', 'fa-arrows-h', 'fa-arrows-v', 'fa-asterisk', 'fa-at', 'fa-automobile', 'fa-backward', 'fa-balance-scale', 'fa-ban', 'fa-bank', 'fa-bar-chart', 'fa-bar-chart-o', 'fa-barcode', 'fa-bars', 'fa-battery-0', 'fa-battery-1', 'fa-battery-2', 'fa-battery-3', 'fa-battery-4', 'fa-battery-empty', 'fa-battery-full', 'fa-battery-half', 'fa-battery-quarter', 'fa-battery-three-quarters', 'fa-bed', 'fa-beer', 'fa-behance', 'fa-behance-square', 'fa-bell', 'fa-bell-o', 'fa-bell-slash', 'fa-bell-slash-o', 'fa-bicycle', 'fa-binoculars', 'fa-birthday-cake', 'fa-bitbucket', 'fa-bitbucket-square', 'fa-bitcoin', 'fa-black-tie', 'fa-bluetooth', 'fa-bluetooth-b', 'fa-bold', 'fa-bolt', 'fa-bomb', 'fa-book', 'fa-bookmark', 'fa-bookmark-o', 'fa-briefcase', 'fa-btc', 'fa-bug', 'fa-building', 'fa-building-o', 'fa-bullhorn', 'fa-bullseye', 'fa-bus', 'fa-buysellads', 'fa-cab', 'fa-calculator', 'fa-calendar', 'fa-calendar-check-o', 'fa-calendar-minus-o', 'fa-calendar-o', 'fa-calendar-plus-o', 'fa-calendar-times-o', 'fa-camera', 'fa-camera-retro', 'fa-car', 'fa-caret-down', 'fa-caret-left', 'fa-caret-right', 'fa-caret-square-o-down', 'fa-caret-square-o-left', 'fa-caret-square-o-right', 'fa-caret-square-o-up', 'fa-caret-up', 'fa-cart-arrow-down', 'fa-cart-plus', 'fa-cc', 'fa-cc-amex', 'fa-cc-diners-club', 'fa-cc-discover', 'fa-cc-jcb', 'fa-cc-mastercard', 'fa-cc-paypal', 'fa-cc-stripe', 'fa-cc-visa', 'fa-certificate', 'fa-chain', 'fa-chain-broken', 'fa-check', 'fa-check-circle', 'fa-check-circle-o', 'fa-check-square', 'fa-check-square-o', 'fa-chevron-circle-down', 'fa-chevron-circle-left', 'fa-chevron-circle-right', 'fa-chevron-circle-up', 'fa-chevron-down', 'fa-chevron-left', 'fa-chevron-right', 'fa-chevron-up', 'fa-child', 'fa-chrome', 'fa-circle', 'fa-circle-o', 'fa-circle-o-notch', 'fa-circle-thin', 'fa-clipboard', 'fa-clock-o', 'fa-clone', 'fa-close', 'fa-cloud', 'fa-cloud-download', 'fa-cloud-upload', 'fa-cny', 'fa-code', 'fa-code-fork', 'fa-codepen', 'fa-codiepie', 'fa-coffee', 'fa-cog', 'fa-cogs', 'fa-columns', 'fa-comment', 'fa-comment-o', 'fa-commenting', 'fa-commenting-o', 'fa-comments', 'fa-comments-o', 'fa-compass', 'fa-compress', 'fa-connectdevelop', 'fa-contao', 'fa-copy', 'fa-copyright', 'fa-creative-commons', 'fa-credit-card', 'fa-credit-card-alt', 'fa-crop', 'fa-crosshairs', 'fa-css3', 'fa-cube', 'fa-cubes', 'fa-cut', 'fa-cutlery', 'fa-dashboard', 'fa-dashcube', 'fa-database', 'fa-dedent', 'fa-delicious', 'fa-desktop', 'fa-deviantart', 'fa-diamond', 'fa-digg', 'fa-dollar', 'fa-dot-circle-o', 'fa-download', 'fa-dribbble', 'fa-dropbox', 'fa-drupal', 'fa-edge', 'fa-edit', 'fa-eject', 'fa-ellipsis-h', 'fa-ellipsis-v', 'fa-empire', 'fa-envelope', 'fa-envelope-o', 'fa-envelope-square', 'fa-eraser', 'fa-eur', 'fa-euro', 'fa-exchange', 'fa-exclamation', 'fa-exclamation-circle', 'fa-exclamation-triangle', 'fa-expand', 'fa-expeditedssl', 'fa-external-link', 'fa-external-link-square', 'fa-eye', 'fa-eye-slash', 'fa-eyedropper', 'fa-facebook', 'fa-facebook-f', 'fa-facebook-official', 'fa-facebook-square', 'fa-fast-backward', 'fa-fast-forward', 'fa-fax', 'fa-feed', 'fa-female', 'fa-fighter-jet', 'fa-file', 'fa-file-archive-o', 'fa-file-audio-o', 'fa-file-code-o', 'fa-file-excel-o', 'fa-file-image-o', 'fa-file-movie-o', 'fa-file-o', 'fa-file-pdf-o', 'fa-file-photo-o', 'fa-file-picture-o', 'fa-file-powerpoint-o', 'fa-file-sound-o', 'fa-file-text', 'fa-file-text-o', 'fa-file-video-o', 'fa-file-word-o', 'fa-file-zip-o', 'fa-files-o', 'fa-film', 'fa-filter', 'fa-fire', 'fa-fire-extinguisher', 'fa-firefox', 'fa-flag', 'fa-flag-checkered', 'fa-flag-o', 'fa-flash', 'fa-flask', 'fa-flickr', 'fa-floppy-o', 'fa-folder', 'fa-folder-o', 'fa-folder-open', 'fa-folder-open-o', 'fa-font', 'fa-fonticons', 'fa-fort-awesome', 'fa-forumbee', 'fa-forward', 'fa-foursquare', 'fa-frown-o', 'fa-futbol-o', 'fa-gamepad', 'fa-gavel', 'fa-gbp', 'fa-ge', 'fa-gear', 'fa-gears', 'fa-genderless', 'fa-get-pocket', 'fa-gg', 'fa-gg-circle', 'fa-gift', 'fa-git', 'fa-git-square', 'fa-github', 'fa-github-alt', 'fa-github-square', 'fa-gittip', 'fa-glass', 'fa-globe', 'fa-google', 'fa-google-plus', 'fa-google-plus-square', 'fa-google-wallet', 'fa-graduation-cap', 'fa-gratipay', 'fa-group', 'fa-h-square', 'fa-hacker-news', 'fa-hand-grab-o', 'fa-hand-lizard-o', 'fa-hand-o-down', 'fa-hand-o-left', 'fa-hand-o-right', 'fa-hand-o-up', 'fa-hand-paper-o', 'fa-hand-peace-o', 'fa-hand-pointer-o', 'fa-hand-rock-o', 'fa-hand-scissors-o', 'fa-hand-spock-o', 'fa-hand-stop-o', 'fa-hashtag', 'fa-hdd-o', 'fa-header', 'fa-headphones', 'fa-heart', 'fa-heart-o', 'fa-heartbeat', 'fa-history', 'fa-home', 'fa-hospital-o', 'fa-hotel', 'fa-hourglass', 'fa-hourglass-1', 'fa-hourglass-2', 'fa-hourglass-3', 'fa-hourglass-end', 'fa-hourglass-half', 'fa-hourglass-o', 'fa-hourglass-start', 'fa-houzz', 'fa-html5', 'fa-i-cursor', 'fa-ils', 'fa-image', 'fa-inbox', 'fa-indent', 'fa-industry', 'fa-info', 'fa-info-circle', 'fa-inr', 'fa-instagram', 'fa-institution', 'fa-internet-explorer', 'fa-intersex', 'fa-ioxhost', 'fa-italic', 'fa-joomla', 'fa-jpy', 'fa-jsfiddle', 'fa-key', 'fa-keyboard-o', 'fa-krw', 'fa-language', 'fa-laptop', 'fa-lastfm', 'fa-lastfm-square', 'fa-leaf', 'fa-leanpub', 'fa-legal', 'fa-lemon-o', 'fa-level-down', 'fa-level-up', 'fa-life-bouy', 'fa-life-buoy', 'fa-life-ring', 'fa-life-saver', 'fa-lightbulb-o', 'fa-line-chart', 'fa-link', 'fa-linkedin', 'fa-linkedin-square', 'fa-linux', 'fa-list', 'fa-list-alt', 'fa-list-ol', 'fa-list-ul', 'fa-location-arrow', 'fa-lock', 'fa-long-arrow-down', 'fa-long-arrow-left', 'fa-long-arrow-right', 'fa-long-arrow-up', 'fa-magic', 'fa-magnet', 'fa-mail-forward', 'fa-mail-reply', 'fa-mail-reply-all', 'fa-male', 'fa-map', 'fa-map-marker', 'fa-map-o', 'fa-map-pin', 'fa-map-signs', 'fa-mars', 'fa-mars-double', 'fa-mars-stroke', 'fa-mars-stroke-h', 'fa-mars-stroke-v', 'fa-maxcdn', 'fa-meanpath', 'fa-medium', 'fa-medkit', 'fa-meh-o', 'fa-mercury', 'fa-microphone', 'fa-microphone-slash', 'fa-minus', 'fa-minus-circle', 'fa-minus-square', 'fa-minus-square-o', 'fa-mixcloud', 'fa-mobile', 'fa-mobile-phone', 'fa-modx', 'fa-money', 'fa-moon-o', 'fa-mortar-board', 'fa-motorcycle', 'fa-mouse-pointer', 'fa-music', 'fa-navicon', 'fa-neuter', 'fa-newspaper-o', 'fa-object-group', 'fa-object-ungroup', 'fa-odnoklassniki', 'fa-odnoklassniki-square', 'fa-opencart', 'fa-openid', 'fa-opera', 'fa-optin-monster', 'fa-outdent', 'fa-pagelines', 'fa-paint-brush', 'fa-paper-plane', 'fa-paper-plane-o', 'fa-paperclip', 'fa-paragraph', 'fa-paste', 'fa-pause', 'fa-pause-circle', 'fa-pause-circle-o', 'fa-paw', 'fa-paypal', 'fa-pencil', 'fa-pencil-square', 'fa-pencil-square-o', 'fa-percent', 'fa-phone', 'fa-phone-square', 'fa-photo', 'fa-picture-o', 'fa-pie-chart', 'fa-pied-piper', 'fa-pied-piper-alt', 'fa-pinterest', 'fa-pinterest-p', 'fa-pinterest-square', 'fa-plane', 'fa-play', 'fa-play-circle', 'fa-play-circle-o', 'fa-plug', 'fa-plus', 'fa-plus-circle', 'fa-plus-square', 'fa-plus-square-o', 'fa-power-off', 'fa-print', 'fa-product-hunt', 'fa-puzzle-piece', 'fa-qq', 'fa-qrcode', 'fa-question', 'fa-question-circle', 'fa-quote-left', 'fa-quote-right', 'fa-ra', 'fa-random', 'fa-rebel', 'fa-recycle', 'fa-reddit', 'fa-reddit-alien', 'fa-reddit-square', 'fa-refresh', 'fa-registered', 'fa-remove', 'fa-renren', 'fa-reorder', 'fa-repeat', 'fa-reply', 'fa-reply-all', 'fa-retweet', 'fa-rmb', 'fa-road', 'fa-rocket', 'fa-rotate-left', 'fa-rotate-right', 'fa-rouble', 'fa-rss', 'fa-rss-square', 'fa-rub', 'fa-ruble', 'fa-rupee', 'fa-safari', 'fa-save', 'fa-scissors', 'fa-scribd', 'fa-search', 'fa-search-minus', 'fa-search-plus', 'fa-sellsy', 'fa-send', 'fa-send-o', 'fa-server', 'fa-share', 'fa-share-alt', 'fa-share-alt-square', 'fa-share-square', 'fa-share-square-o', 'fa-shekel', 'fa-sheqel', 'fa-shield', 'fa-ship', 'fa-shirtsinbulk', 'fa-shopping-bag', 'fa-shopping-basket', 'fa-shopping-cart', 'fa-sign-in', 'fa-sign-out', 'fa-signal', 'fa-simplybuilt', 'fa-sitemap', 'fa-skyatlas', 'fa-skype', 'fa-slack', 'fa-sliders', 'fa-slideshare', 'fa-smile-o', 'fa-soccer-ball-o', 'fa-sort', 'fa-sort-alpha-asc', 'fa-sort-alpha-desc', 'fa-sort-amount-asc', 'fa-sort-amount-desc', 'fa-sort-asc', 'fa-sort-desc', 'fa-sort-down', 'fa-sort-numeric-asc', 'fa-sort-numeric-desc', 'fa-sort-up', 'fa-soundcloud', 'fa-space-shuttle', 'fa-spinner', 'fa-spoon', 'fa-spotify', 'fa-square', 'fa-square-o', 'fa-stack-exchange', 'fa-stack-overflow', 'fa-star', 'fa-star-half', 'fa-star-half-empty', 'fa-star-half-full', 'fa-star-half-o', 'fa-star-o', 'fa-steam', 'fa-steam-square', 'fa-step-backward', 'fa-step-forward', 'fa-stethoscope', 'fa-sticky-note', 'fa-sticky-note-o', 'fa-stop', 'fa-stop-circle', 'fa-stop-circle-o', 'fa-street-view', 'fa-strikethrough', 'fa-stumbleupon', 'fa-stumbleupon-circle', 'fa-subscript', 'fa-subway', 'fa-suitcase', 'fa-sun-o', 'fa-superscript', 'fa-support', 'fa-table', 'fa-tablet', 'fa-tachometer', 'fa-tag', 'fa-tags', 'fa-tasks', 'fa-taxi', 'fa-television', 'fa-tencent-weibo', 'fa-terminal', 'fa-text-height', 'fa-text-width', 'fa-th', 'fa-th-large', 'fa-th-list', 'fa-thumb-tack', 'fa-thumbs-down', 'fa-thumbs-o-down', 'fa-thumbs-o-up', 'fa-thumbs-up', 'fa-ticket', 'fa-times', 'fa-times-circle', 'fa-times-circle-o', 'fa-tint', 'fa-toggle-down', 'fa-toggle-left', 'fa-toggle-off', 'fa-toggle-on', 'fa-toggle-right', 'fa-toggle-up', 'fa-trademark', 'fa-train', 'fa-transgender', 'fa-transgender-alt', 'fa-trash', 'fa-trash-o', 'fa-tree', 'fa-trello', 'fa-tripadvisor', 'fa-trophy', 'fa-truck', 'fa-try', 'fa-tty', 'fa-tumblr', 'fa-tumblr-square', 'fa-turkish-lira', 'fa-tv', 'fa-twitch', 'fa-twitter', 'fa-twitter-square', 'fa-umbrella', 'fa-underline', 'fa-undo', 'fa-university', 'fa-unlink', 'fa-unlock', 'fa-unlock-alt', 'fa-unsorted', 'fa-upload', 'fa-usb', 'fa-usd', 'fa-user', 'fa-user-md', 'fa-user-plus', 'fa-user-secret', 'fa-user-times', 'fa-users', 'fa-venus', 'fa-venus-double', 'fa-venus-mars', 'fa-viacoin', 'fa-video-camera', 'fa-vimeo', 'fa-vimeo-square', 'fa-vine', 'fa-vk', 'fa-volume-down', 'fa-volume-off', 'fa-volume-up', 'fa-warning', 'fa-wechat', 'fa-weibo', 'fa-weixin', 'fa-whatsapp', 'fa-wheelchair', 'fa-wifi', 'fa-wikipedia-w', 'fa-windows', 'fa-won', 'fa-wordpress', 'fa-wrench', 'fa-xing', 'fa-xing-square', 'fa-y-combinator', 'fa-y-combinator-square', 'fa-yahoo', 'fa-yc', 'fa-yc-square', 'fa-yelp', 'fa-yen', 'fa-youtube', 'fa-youtube-play', 'fa-youtube-square']; ?>

        {{!-- loop for icons --}}
        <ul class="nuBloxModule_icon_iconslist">
            <?php foreach ($nuBloxModule_icon_iconslist as $key => $value) { ?>
                <li data-nublox-module-icon-clickedicon="<?php echo $value; ?>" class="{{nuBloxModule_icon ico='<?php echo $value; ?>'}}">
                    <i class="fa <?php echo $value; ?>"></i>
                </li>
            <?php } ?>
        </ul>

    </div>
</script>

<script type="text/javascript">
jQuery( document ).ready(function( $ )
{
    // click event
    $('body').on('click','[data-nublox-module-icon-clickedicon]',function(){
        var attr = $(this).attr('data-nublox-module-icon-clickedicon');
        $('.nuBloxModule_icon_input').val(attr);
        $('[data-nublox-module-icon-clickedicon]').removeClass('nuBloxModule_icon_select');
        $(this).addClass('nuBloxModule_icon_select');
    });

    // handlebar helper
    Handlebars.registerHelper('nuBloxModule_icon', function(ico) {
        if (this.icon === ico.hash.ico)
            return 'nuBloxModule_icon_select';
        else {
            return;
        }
    });
});
</script>

<style>
.nuBloxModule_icon_iconslist li {
    display: inline-block;
    background: #eee;
    width: 40px;
    height: 40px;
    text-align: center;
    font-size: 20px;
    line-height: 20px;
    margin-bottom: 5px;
    cursor: pointer;
    opacity: 0.7;
}

.nuBloxModule_icon_iconslist li:hover {
    opacity: 1;
}

.nuBloxModule_icon_iconslist li i {
    padding-top: 10px;
}

.nuBloxModule_icon_select {
    background: yellow !important;
}
</style>
