/*
jQuery plugin to add functionality to your forms to add multiple records on single click on the fly using client side javascript
author: Vipul Limbachiya
http://vipulilmbachiya.com
*/

/*
* This program is free software. It comes without any warranty, to the extent permitted by applicable law.
* You can redistribute it and/or modify it without any terms.
* Save developers, use Firefox http://firefox.com
*/

(function ($) {
    $.fn.EnableMultiField = function (options) {
        options = $.extend({
            linkText: 'Add more',
            linkClass: 'addMoreFields',
            enableRemove: true,
            removeLinkText: 'Remove',
            removeLinkClass: 'removeFields',
            confirmOnRemove: true,
            confirmationMsgOnRemove: 'Are you sure you wish to remove selected field(s)?',
            beforeAddEventCallback: null,
            addEventCallback: null,
            removeEventCallback: null,
            maxItemsAllowedToAdd: null,
            maxItemReachedCallback: null,
            data: []
        },
        options);

        return this.each(function () {
            var self = $(this);

            $(self).attr("TotalFieldsAdded", "0");

            $(self).attr("maxCountReached", "false");

            $(self).attr("FieldCount", "0");

            $(self).attr("uniqueId", options.linkClass + Math.random());

            $(self).find("." + options.linkClass).remove();

            $(self).find("." + options.removeLinkClass).remove();

            $(self).append(" <a href='#' class='" + options.linkClass + "'>" + options.linkText + "</a>");

            $(self).find("." + options.linkClass).unbind("click").click(function () {
                return handleAdd($(this));
            });

            var myClone = $(self).clone();

            if (options.data.length > 0) {
                var $curElem = $(self);
                for (var i = 0; i < options.data.length; i++) {                                        
                    $curElem.find("input,select,textarea").each(function () {
                        var itemName = $(this).attr("recName");
                        $(this).val(options.data[i][itemName]);
                    });
                    $curElem.find("." + options.linkClass).trigger("click");
                    $curElem = $curElem.next();
                }
            }

            function handleAdd(elem) {
                if (options.beforeAddEventCallback !== null) {
                    if (!options.beforeAddEventCallback(self)) {
                        return false;
                    }
                }
                var totalCount = parseInt($(self).attr("TotalFieldsAdded"), 10);
                var fieldCount = parseInt($(self).attr("FieldCount"), 10);
                if (options.maxItemsAllowedToAdd === null || totalCount < options.maxItemsAllowedToAdd) {
                    var newElem = myClone.clone();

                    $(newElem).find("*[id!=''][name!='']").each(function () {
                        if ($(this).attr("id")) {
                            var strid = $(this).attr("id");
                            var strname = "";

                            if ($(this).attr("name")) {
                                strname = $(this).attr("name");
                            }

                            $(this).attr("id", strid + "_" + fieldCount);
                            $(this).attr("name", strname);
                        }
                    });

                    totalCount++;
                    fieldCount++;

                    $(self).attr("TotalFieldsAdded", totalCount);
                    $(self).attr("FieldCount", fieldCount);

                    $(newElem).removeAttr("uniqueId");

                    if (options.enableRemove && $(self).attr("uniqueId") != $(elem).parent().attr("uniqueId")) {
                        if ($(elem).parent().find("." + options.removeLinkClass).length === 0) {
                            $(elem).parent().append(" <a href='#' class='" + options.removeLinkClass + "'>" + options.removeLinkText + "</a>");
                        }
                        $(elem).parent().find("." + options.removeLinkClass).unbind("click").click(function () {
                            return handleRemove($(this));
                        });
                    }

                    $(newElem).attr("uniqueId", options.linkClass + Math.random());

                    $(elem).parent().after(newElem);

                    $(elem).parent().find("." + options.linkClass).remove();

                    $(newElem).find("." + options.linkClass).remove();
                    $(newElem).find("." + options.removeLinkClass).remove();

                    if (options.enableRemove) {
                        if ($(newElem).find("." + options.removeLinkClass).length === 0) {
                            $(newElem).append(" <a href='#' class='" + options.removeLinkClass + "'>" + options.removeLinkText + "</a>");
                        }
                        $(newElem).find("." + options.removeLinkClass).unbind("click").click(function () {
                            return handleRemove($(this));
                        });
                    }

                    $(self).attr("maxCountReached", "false");

                    $(newElem).append(" <a href='#' class='" + options.linkClass + "'>" + options.linkText + "</a>");

                    newElem.find("." + options.linkClass).unbind("click").click(function () {
                        return handleAdd($(this));
                    });

                    if (options.addEventCallback !== null) {
                        options.addEventCallback($(newElem), self);
                    }
                }

                if (options.maxItemsAllowedToAdd !== null && totalCount >= options.maxItemsAllowedToAdd) {
                    newElem.find("." + options.linkClass).hide();

                    if (options.maxItemReachedCallback !== null) {
                        options.maxItemReachedCallback($(newElem), self);
                    }
                }

                return false;
            }

            function handleRemove(elem) {
                var cnt = true;

                if (options.confirmOnRemove) {
                    cnt = confirm(options.confirmationMsgOnRemove);
                }
                if (cnt) {
                    var prevParent = $(elem).parent().prev();

                    var totalCount = parseInt($(self).attr("TotalFieldsAdded"), 10);
                    totalCount--;

                    $(self).attr("TotalFieldsAdded", totalCount);

                    if ($(elem).parent().find("." + options.linkClass).length > 0) {
                        if (options.enableRemove && $(self).attr("uniqueId") != $(prevParent).attr("uniqueId")) {
                            if ($(prevParent).find("." + options.removeLinkClass).length === 0) {
                                $(prevParent).append(" <a href='#' class='" + options.removeLinkClass + "'>" + options.removeLinkText + "</a>");
                            }

                            $(prevParent).find("." + options.removeLinkClass).unbind("click").click(function () {
                                return handleRemove($(this));
                            });
                        }

                        $(prevParent).append(" <a href='#' class='" + options.linkClass + "'>" + options.linkText + "</a>");

                        prevParent.find("." + options.linkClass).unbind("click").click(function () {
                            return handleAdd($(this));
                        });
                    }

                    if (options.maxItemsAllowedToAdd !== null && totalCount < options.maxItemsAllowedToAdd) {
                        $(self).siblings().find("." + options.linkClass).show();
                    }

                    $(elem).parent().remove();

                    if (options.removeEventCallback !== null) {
                        options.removeEventCallback($(prevParent), self);
                    }
                }
                return false;
            }
        });
    };
})(jQuery);