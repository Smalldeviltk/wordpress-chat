/*!
 * Bootstrap Confirmation
 * Copyright 2013 Nimit Suwannagate <ethaizone@hotmail.com>
 * Copyright 2014 Damien "Mistic" Sorel <http://www.strangeplanet.fr>
 * Licensed under the Apache License, Version 2.0 (the "License")
 */

(function ($) {
	var objicon = {
		icon_01:"icon/facebook/10520138_icon_01.png",
		icon_02:"icon/facebook/10520138_icon_02.png",
		icon_03:"icon/facebook/10520138_icon_03.png",
		icon_04:"icon/facebook/10520138_icon_04.png",
		icon_05:"icon/facebook/10520138_icon_05.png",
		icon_06:"icon/facebook/10520138_icon_06.png",
		icon_07:"icon/facebook/10520138_icon_07.png",
		icon_08:"icon/facebook/10520138_icon_08.png",
		icon_09:"icon/facebook/10520138_icon_09.png",
		icon_10:"icon/facebook/10520138_icon_10.png",
		icon_11:"icon/facebook/10520138_icon_11.png",
		icon_12:"icon/facebook/10520138_icon_12.png",
		icon_13:"icon/facebook/10520138_icon_13.png",
		icon_14:"icon/facebook/10520138_icon_14.png",
		icon_15:"icon/facebook/10520138_icon_15.png",
		icon_16:"icon/facebook/10520138_icon_16.png",
		icon_17:"icon/facebook/10520138_icon_17.png",
		icon_18:"icon/facebook/10520138_icon_18.png",
		icon_19:"icon/facebook/10520138_icon_19.png",
		icon_20:"icon/facebook/10520138_icon_20.png",
		icon_21:"icon/facebook/10520138_icon_21.png",
		icon_22:"icon/facebook/10520138_icon_22.png",
		icon_23:"icon/facebook/10520138_icon_23.png",
		icon_24:"icon/facebook/10520138_icon_24.png",
		icon_25:"icon/facebook/10520138_icon_25.png",
		icon_26:"icon/facebook/10520138_icon_26.png",
		icon_27:"icon/facebook/10520138_icon_27.png",
		icon_28:"icon/facebook/10520138_icon_28.png",
		icon_29:"icon/facebook/10520138_icon_29.png",
		icon_30:"icon/facebook/10520138_icon_30.png",
		icon_31:"icon/facebook/10520138_icon_31.png",
		icon_32:"icon/facebook/10520138_icon_32.png",
		icon_33:"icon/facebook/10520138_icon_33.png",
		icon_34:"icon/facebook/10520138_icon_34.png",
		icon_35:"icon/facebook/10520138_icon_35.png",
		icon_36:"icon/facebook/10520138_icon_36.png",
		icon_37:"icon/facebook/10520138_icon_37.png",
		icon_38:"icon/facebook/10520138_icon_38.png",
		icon_39:"icon/facebook/10520138_icon_39.png",
		icon_40:"icon/facebook/10520138_icon_40.png",
		icon_41:"icon/facebook/10520138_icon_41.png",
		icon_42:"icon/facebook/10520138_icon_42.png",
		icon_43:"icon/facebook/10520138_icon_43.png",
		icon_44:"icon/facebook/10520138_icon_44.png"
	};
	
	var stt_col = 1;
	var stt_row = 1;
	var list_icon = '<tr pagecol="'+stt_col+'" pagerow="'+stt_row+'" class="chaticon showpaging">';
	var id = 0;
	for (var key in objicon) {
		id++;
		var value = objicon[key];
		list_icon += '<td>'+
						'<button type="button" class="btn btn-default btn-icon" value="'+key+'" onclick="InsertIcon(this)" title="'+key+'" style="display: inline-block;">'+
							'<img src="'+value+'" height=30 width=30 />'+
						'</button>'+
					'</td>';
		if(id % 4 == 0 & id < Object.keys(objicon).length){
			stt_col++;
			//list_icon = list_icon+'</tr><tr pagecol="'+stt_col+'">';
			if(id % 12 == 0 & id < Object.keys(objicon).length){
				stt_row++;
				//list_icon = list_icon+'</tr><tr pagerow="'+stt_row+'">';
			}
			if(stt_row == 1){
				list_icon = list_icon+'</tr><tr pagecol="'+stt_col+'" pagerow="'+stt_row+'" class="chaticon showpaging">';
			}
			else{
				list_icon = list_icon+'</tr><tr pagecol="'+stt_col+'" pagerow="'+stt_row+'" class="chaticon hidepaging">';
			}
			//list_icon = list_icon+'</tr><tr pagecol="'+stt_col+'" pagerow="'+stt_row+'" class="hidepaging">';
		}
		
	}
	list_icon = list_icon+'</tr>';
	
  'use strict';

  // Confirmation extends popover.js
  if (!$.fn.popover) throw new Error('Confirmation requires popover.js');

  // CONFIRMATION PUBLIC CLASS DEFINITION
  // ===============================
  var Confirmation = function (element, options) {
    this.init('confirmation', element, options);

    var that = this;

    if (!this.options.selector) {
      // get existing href and target
      if (this.$element.attr('href')) {
        this.options.href = this.$element.attr('href');
        this.$element.removeAttr('href');
        if (this.$element.attr('target')) {
          this.options.target = this.$element.attr('target');
        }
      }

      // cancel original event
      this.$element.on(that.options.trigger, function(e, ack) {
        if (!ack) {
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
        }
      });

      // trigger original event on confirm
      this.$element.on('confirmed.bs.confirmation', function(e) {
        $(this).trigger(that.options.trigger, [true]);
      });

      // manage singleton
      this.$element.on('show.bs.confirmation', function(e) {
        if (that.options.singleton) {
          // close all other popover already initialized
          $(that.options._selector).not($(this)).filter(function() {
            return $(this).data('bs.confirmation') !== undefined;
          }).confirmation('hide');
        }
      });
    }

    if (!this.options._isDelegate) {
      // manage popout
      this.eventBody = false;
      this.uid = this.$element[0].id || this.getUID('group_');

      this.$element.on('shown.bs.confirmation', function(e) {
        if (that.options.popout && !that.eventBody) {
          var $this = $(this);
          that.eventBody = $('body').on('click.bs.confirmation.'+that.uid, function(e) {
            if ($(that.options._selector).is(e.target)) {
              return;
            }
  
            // close all popover already initialized
            $(that.options._selector).filter(function() {
              return $(this).data('bs.confirmation') !== undefined;
            }).confirmation('hide');

            $('body').off('click.bs.'+that.uid);
            that.eventBody = false;
          });
        }
      });
    }
  };

  Confirmation.DEFAULTS = $.extend({}, $.fn.popover.Constructor.DEFAULTS, {
    placement: 'top',
    title: 'Chọn Icon',
    html: true,
    href: false,
    popout: false,
    singleton: false,
    target: '_self',
    onConfirm: $.noop,
    onCancel: $.noop,
    btnOkClass: 'btn-xs btn-primary',
    btnOkIcon: 'glyphicon glyphicon-ok',
    btnOkLabel: 'Yes',
    btnCancelClass: 'btn-xs btn-default',
    btnCancelIcon: 'glyphicon glyphicon-remove',
    btnCancelLabel: 'Đóng',
    template:
      '<div class="popover confirmation">' +
        '<div class="arrow"></div>' +
        '<h3 class="popover-title"></h3>' +
        '<div class="popover-content text-center">'+
          '<table class="table-icons">'+
    '<thead>'+
        '<!--<tr>'+
            '<td class="text-center">'+
                '<button class="btn btn-arrow btn-previous btn-primary disabled" value="-1">'+
                    '<span class="glyphicon glyphicon-arrow-left">'+'</span>'+
                '</button>'+
            '</td>'+
            '<td class="text-center" colspan="8">'+
                '<span class="page-count">1 / 1</span>'+
            '</td>'+
            '<td class="text-center">'+
                '<button class="btn btn-arrow btn-next btn-primary" value="1">'+
                    '<span class="glyphicon glyphicon-arrow-right">'+'</span>'+
                '</button>'+
            '</td>'+
        '</tr>'+
        '<tr style="display: table-row;">'+
            '<td colspan="10">'+
                '<input type="text" class="form-control search-control" style="width: 390px;" placeholder="Search icon">'+
                '</td>'+
            '</tr>-->'+
        '</thead>'+
        '<tbody>'+list_icon+
		'<tr>'+
            '<!--<td><a class="btn" data-apply="confirmation"></a></td>-->'+
            '<td colspan="4" style="padding-top: 10px;"><a class="btn" data-dismiss="confirmation"></a></td>'+
          '</tr>'+
        '</tbody>'+
        '<tfoot>'+
            '<!--<tr>'+
                '<td colspan="10" class="text-center">'+
                    '<span class="icons-count">1 - 44 của 44</span>'+
                '</td>'+
            '</tr>-->'+
			'<ul class="pager" style="margin:10px 0">'+
				'<li class="previous disabled"><a onclick="pagingIcon(\'giam\')">&larr; Trước</a></li>'+
				'<li class="thamso"><a>1/'+stt_row+'</a></li>'+
				'<li class="next"><a onclick="pagingIcon(\'tang\')">Sau &rarr;</a></li>'+
			'</ul>'+
        '</tfoot>'+
    '</table>'+
        '</div>'+
      '</div>'
  });

  Confirmation.prototype = $.extend({}, $.fn.popover.Constructor.prototype);

  Confirmation.prototype.constructor = Confirmation;

  Confirmation.prototype.getDefaults = function () {
  
    return Confirmation.DEFAULTS;

  };

  // custom init keeping trace of selectors
  Confirmation.prototype.init = function(type, element, options) {
    $.fn.popover.Constructor.prototype.init.call(this, type, element, options);

    this.options._isDelegate = false;
    if (options.selector) { // container of buttons
      this.options._selector = this._options._selector = options._root_selector +' '+ options.selector;
    }
    else if (options._selector) { // children of container
      this.options._selector = options._selector;
      this.options._isDelegate = true;
    }
    else { // standalone
      this.options._selector = options._root_selector;
    }
  };

  Confirmation.prototype.setContent = function () {
    var that = this,
        $tip = this.tip(),
        o = this.options;

    $tip.find('.popover-title')[o.html ? 'html' : 'text'](this.getTitle());

    // configure 'ok' button
    $tip.find('[data-apply="confirmation"]')
      .addClass(o.btnOkClass)
      .html(o.btnOkLabel)
      .prepend($('<i></i>').addClass(o.btnOkIcon), ' ')
      .off('click')
      .one('click', function(e) {
        that.getOnConfirm.call(that).call(that.$element);
        that.$element.trigger('confirmed.bs.confirmation');
        that.leave(that);
      });

    // add href to confirm button if needed
    if (o.href && o.href != "#") {
      $tip.find('[data-apply="confirmation"]').attr({
        href: o.href,
        target: o.target
      });
    }

    // configure 'cancel' button
    $tip.find('[data-dismiss="confirmation"]')
      .addClass(o.btnCancelClass)
      .html(o.btnCancelLabel)
      .prepend($('<i></i>').addClass(o.btnCancelIcon), ' ')
      .off('click')
      .one('click', function(e) {
        that.getOnCancel.call(that).call(that.$element);
        that.$element.trigger('canceled.bs.confirmation');
        that.leave(that);
      });

    $tip.removeClass('fade top bottom left right in');

    // IE8 doesn't accept hiding via the `:empty` pseudo selector, we have to do
    // this manually by checking the contents.
    if (!$tip.find('.popover-title').html()) {
      $tip.find('.popover-title').hide();
    }
  };

  Confirmation.prototype.getOnConfirm = function() {
    if (this.$element.attr('data-on-confirm')) {
      return getFunctionFromString(this.$element.attr('data-on-confirm'));
    }
    else {
      return this.options.onConfirm;
    }
  };

  Confirmation.prototype.getOnCancel = function() {
    if (this.$element.attr('data-on-cancel')) {
      return getFunctionFromString(this.$element.attr('data-on-cancel'));
    }
    else {
      return this.options.onCancel;
    }
  };

  /*
   * Generates an anonymous function from a function name
   * function name may contain dots (.) to navigate through objects
   * root context is window
   */
  function getFunctionFromString(functionName) {
    var context = window,
        namespaces = functionName.split('.'),
        func = namespaces.pop();

    for (var i=0, l=namespaces.length; i<l; i++) {
      context = context[namespaces[i]];
    }

    return function() {
      context[func].call(this);
    };
  }


  // CONFIRMATION PLUGIN DEFINITION
  // =========================

  var old = $.fn.confirmation;

  $.fn.confirmation = function (option) {
    var options = (typeof option == 'object' && option) || {};
    options._root_selector = this.selector;

    return this.each(function () {
      var $this = $(this),
          data  = $this.data('bs.confirmation');

      if (!data && option == 'destroy') {
        return;
      }
      if (!data) {
        $this.data('bs.confirmation', (data = new Confirmation(this, options)));
      }
      if (typeof option == 'string') {
        data[option]();
      }
    });
  };

  $.fn.confirmation.Constructor = Confirmation;


  // CONFIRMATION NO CONFLICT
  // ===================

  $.fn.confirmation.noConflict = function () {
    $.fn.confirmation = old;
    return this;
  };

}(jQuery));
