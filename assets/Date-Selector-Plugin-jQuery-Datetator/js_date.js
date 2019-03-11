/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
			var $activate_datetator1 = $('#activate_datetator1');
			var $inputDatetator1 = $('#inputDatetator1');
			$activate_datetator1.click(function () {
				if ($inputDatetator1.data('datetator') === undefined) {
					$inputDatetator1.datetator({
						useDimmer: true
					});
					$activate_datetator1.val('destroy datetator');
				} else {
					$inputDatetator1.datetator('destroy');
					$activate_datetator1.val('activate datetator');
				}
			});
			$activate_datetator1.trigger('click');

			var $activate_datetator2 = $('#activate_datetator2');
			var $inputDatetator2 = $('#inputDatetator2');
			$activate_datetator2.click(function () {
				if ($inputDatetator2.data('datetator') === undefined) {
					$inputDatetator2.datetator();
					$activate_datetator2.val('destroy datetator');
				} else {
					$inputDatetator2.datetator('destroy');
					$activate_datetator2.val('activate datetator');
				}
			});
			$activate_datetator2.trigger('click');

			var $activate_datetator3 = $('#activate_datetator3');
			var $inputDatetator3 = $('#inputDatetator3');
			$activate_datetator3.click(function () {
				if ($inputDatetator3.data('datetator') === undefined) {
					$inputDatetator3.datetator({
						language: 'de'
					});
					$activate_datetator3.val('destroy datetator');
				} else {
					$inputDatetator3.datetator('destroy');
					$activate_datetator3.val('activate datetator');
				}
			});
			$activate_datetator3.trigger('click');

			var $activate_datetator4 = $('#activate_datetator4');
			var $inputDatetator4 = $('#inputDatetator4');
			$activate_datetator4.click(function () {
				if ($inputDatetator4.data('datetator') === undefined) {
					$inputDatetator4.datetator({
						language: 'fo'
					});
					$activate_datetator4.val('destroy datetator');
				} else {
					$inputDatetator4.datetator('destroy');
					$activate_datetator4.val('activate datetator');
				}
			});
			$activate_datetator4.trigger('click');
		});
	