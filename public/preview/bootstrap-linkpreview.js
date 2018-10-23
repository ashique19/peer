/* =========================================================
 * bootstrap-linkpreview.js
 * http://www.github.com/ekito/bootstrap-linkpreview
 *
 * Use:
 * $("#link").linkpreview({
 *     url: "http://romainpiel.com",            //optional
 *     previewContainer: "#preview-container",  //optional
 *     previewContainerClass: "row-fluid",
 *     refreshButton: "#refresh-button",        //optional
 *     preProcess: function() {                 //optional
 *         console.log("preProcess");
 *     },
 *     onSuccess: function() {                  //optional
 *         console.log("onSuccess");
 *     },
 *     onError: function() {                    //optional
 *         console.log("onError");
 *     },
 *     onComplete: function() {                 //optional
 *         console.log("onComplete");
 *     }
 * });
 *
 * =========================================================
 * Copyright 2013 ekito - http://ekito.fr
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */

(function($) {
    
    var LinkPreview = function(element, options) {
        this.init(element, options);
    };
    
    LinkPreview.prototype = {
        constructor: LinkPreview,

        options: null,
        url: null,

        $element: null,
        $previewContainer: null,
        $refreshButton: null,

        init: function(element, options) {

            this.$element = $(element);
            this.options = options;

            if (!this.$element) {
                return;
            }
            
            this.initPreviewContainer();
            this.initUrlValue();

            if (options && options.refreshButton) {
                this.$refreshButton = $(options.refreshButton);

                var that = this;
                this.$refreshButton.on("click", function() {
                    that.emptyPreviewContainer();
                    that.initUrlValue();
                    that.getSource(that.url, that.renderPreview, that.renderError);
                });
            }

            this.getSource(this.url, this.renderPreview, this.renderError);
        },

        initPreviewContainer: function() {
            if (this.getOption("previewContainer")) {
                this.$previewContainer = $(this.options.previewContainer);
            } else {
                this.$previewContainer = this.$element.parent();
            }

            this.$previewContainer.addClass("link-preview");

            if (this.getOption("previewContainerClass")) {
                this.$previewContainer.addClass(this.options.previewContainerClass);
            } else {
                this.$previewContainer.addClass("well row-fluid");
            }
        },

        initUrlValue: function() {
            if (this.getOption("url")) {
                this.url = this.options.url;
            } else {
                this.url =
                    this.$element.attr("href") ||
                    this.$element.text() ||
                    this.$element.val();
            }
            this.url = this.url.replace('https://', 'http://');
            
        },

        emptyPreviewContainer: function() {
            this.$previewContainer.empty();
        },

        getSource: function(url, onSuccess, onError) {

            if (!this.validateUrl(this.url)) {
                return;
            }

            //Amazon specific work
            if((url.indexOf("amazon") !== -1) || (url.indexOf("groupon") !== -1)
                || (this.url.indexOf("jet.com") !== -1) || (this.url.indexOf("wallmart.com") !== -1) 
                || (this.url.indexOf("ebay.com") !== -1)) {
                url = url.replace('https://', 'http://');
            } else {
                //@todo stop when https is working
                url = url.replace('https://', 'http://');
            }
            // if(url.indexOf("amazon.com") !== -1) {
            //     url = url.replace('amazon.com', 'amazon.co.uk');    
            // }
            console.log(url);

            if (typeof this.getOption("preProcess") === "function") {
                this.options.preProcess();
            }

            var that = this;
            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    onSuccess(this.url, data, that);
                    if (typeof that.getOption("onSuccess") === "function") {
                        that.options.onSuccess(data);
                    }
                },
                error: function() {
                    onError(this.url, that);
                    if (typeof that.getOption("onError") === "function") {
                        that.options.onError();
                    }
                },
                complete: function() {
                    if (typeof that.getOption("onComplete") === "function") {
                        that.options.onComplete();
                    }
                }
            });
        },

        renderPreview: function(url, data, that) {
            
            // old request
            if (that.url !== url) {
                return;
            }

            that.emptyPreviewContainer();

            // html to lower case
            data = data.replace(/<\/?[A-Z]+[\w\W]*?>/g, function (m) {
                return m.toLowerCase();
            });

            // parse data to jQuery DOM object
            var dom = document.implementation.createHTMLDocument('');
            dom.body.innerHTML = data;
            var $dom = $(dom);
            
            // get components
            var title = that.findTitleInDom($dom),
                description = that.findDescriptionInDom($dom),
                image = that.findImageInDom($dom),
                price = (url.indexOf("aliexpress") !== -1) ? that.findPriceInDomForAliEx($dom) : that.findPriceInDom($dom);
    
            if(title.indexOf("Amazon.co.uk") !== -1) {
                title = title.replace('Amazon.co.uk', 'Amazon.com');    
            }
            
            if(price ) {
                if(price.indexOf("$") === -1) {
                   price = '$' + price;  
                    
                }
            } else if(typeof price === 'undefined') {
                price = 'N/A';
            }
            price = 'Price: ' + price;
            
            // build dom elements
            var $title = $("<a></a>").attr("href", url).attr("target", '_blank').text(title),
                $price = $("<p></p>").css("font-size", '16px').text(price),
                $description = $("<p></p>").text(description);

            var $spanRight;
            if (image) {
                var $image = $("<img></img>").attr("src", image).css('max-height', '100%').css('max-width', '100%'),
                    $spanLeft = $("<div></div>").addClass("col-sm-5");
                $spanRight = $("<div></div>").addClass("col-sm-5");
                $spanLeft
                    .append($image);
                that.$previewContainer
                    .append($spanLeft);
            } else {
                $spanRight = $("<div></div>");
            }

            $spanRight
                .append($title)
                .append($price)
                .append($description);
            that.$previewContainer
                .append($spanRight);
        },

        renderError: function(url, that) {

            // old request
            if (that.url !== url) {
                return;
            }

            that.emptyPreviewContainer();

            var $alert = $("<div></div>")
                .addClass("alert alert-error");

            if (that.getOption("errorMessage")) {
                $alert.text(that.options.errorMessage);
            } else {
                $alert.text("We are sorry we couldn't load the preview. The URL is invalid.");
            }
                            
            that.$previewContainer.append($alert);
        },

        findTitleInDom: function($dom) {
            return $dom.find("title").text() ||
                $dom.find("meta[name=title]").attr("content");
        },

        findDescriptionInDom: function($dom) {
            return $dom.find("meta[name=description]").attr("content");
        },
        findPriceInDom: function($dom) {
            var priceDom = $dom.find("[itemprop=price]"), price;
            if(typeof priceDom !== 'undefined' && typeof priceDom === 'object') {
                price = priceDom.html();
                
            }else {
                price = priceDom;
            }
            
            return price;
        },
        findPriceInDomForAliEx: function($dom) {
            var priceDom = $dom.find(".p-price"), price;
            if(typeof priceDom !== 'undefined' && typeof priceDom === 'object') {
                price = priceDom.html();
            }else {
                price = priceDom;
            }
            
            return price;
        },
        findImageInDom: function($dom) {
            var imageSrc = $dom.find("meta[itemprop=image]").attr("content") ||
                $dom.find("link[rel=image_src]").attr("content") ||
                $dom.find("meta[itemprop=image]").attr("content") ||
                this.findFirstImageInBody($dom.find("body"));

            // maybe the returned url is relative
            if (imageSrc && !this.validateUrl(imageSrc)) {

                var a = document.createElement("a");
                a.href = this.url;

                imageSrc = a.protocol + "//" + a.hostname + imageSrc;
            }

            return imageSrc;
        },

        findFirstImageInBody: function($body) {
            var result;

            var $images = $body.find("img[src]");

            var $img;
            $images.each(function(index, val) {
                $img = $(this);
                
                if (((($img.attr("height") && $img.attr("height") > 200 && $img.attr("width") && $img.attr("width") > 200)
                    || ( ($img.hasClass("img300") && (index > 1)) || ($img.hasClass("img500") ))
                    || ($img.hasClass('featured-image')))
                    && (this.src.indexOf("imgLoading_30x30") === -1)) || ($img.attr("id") == "landingImage")) {

                    result = this.src;
                    return false;
                }
                
                // if ($img.attr("height") && $img.attr("height") > 20 &&
                //     $img.attr("width") && $img.attr("width") > 20) {
                //     result = this.src;
                //     return false;
                // }
            });
            if(typeof result === 'undefined') {
                if($images[0].src) {    
                    result = $images[0].src;
                } else {
                    result = $images[2].src;
                }
            }

            return result;
        },

        getOption: function(name) {
            if (this.options && this.options[name]) {
                return this.options[name];
            } else {
                return null;
            }
        },

        validateUrl: function(value) {
            return (/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i).test(value);
        }
    };

    $.fn.linkpreview = function (option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('linkpreview'),
                options = typeof option === 'object' && option;

            if (option instanceof LinkPreview) {
                $this.data('linkpreview', (data = option));
                data.init(this, data.options);
            }
            if (!data) {
                $this.data('linkpreview', (data = new LinkPreview(this, $.extend({}, $.fn.linkpreview.defaults, options))));
            }
            if (typeof option === 'string') {
                data[option]();
            }
        });
    };

    $.fn.linkpreview.defaults = {};
    
    $.fn.linkpreview.Constructor = LinkPreview;

})(window.jQuery);