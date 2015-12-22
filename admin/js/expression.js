/*jslint browser: true*/
/*global
    $, window, alert, fs, console
*/
/**
* ExpressionJS (v.0.0.1)
* By Folksyt Team, Hendro Pramana Sinaga - Waspada Tarigan
* MIT License
**/
(function () {
  'use strict';
  window.expression = window.expression || {
    cleanTag: function (data) {
      var pola = /(<[a-z]\/?>|<(\w)?\/[a-z](\w)?>|&(\w);)/g;
      return data.replace(pola, '');
    },
    modals: function (str) {
      if (document.getElementById('modal1') === null) {
        var divMain   = document.createElement('div'),
          divContent  = document.createElement('div'),
          divFooter   = document.createElement('div'),
          htitle      = document.createElement('h4'),
          pContent    = document.createElement('p'),
          aOptions    = document.createElement('a'),
          removed     = function (evt) {
            evt.stopPropagation();
            $(divMain).closeModal();
            $(divMain).remove();
          };

        divMain.setAttribute('id', 'modal1');
        divMain.setAttribute('class', 'modal');

        divContent.setAttribute('class', 'modal-content');
        divFooter.setAttribute('class', 'modal-footer');


        htitle.textContent = "Informasi Aplikasi : ";
        $(htitle).css({
          "padding-bottom": "2px",
          "border-bottom": "1px solid #777"
        });
        pContent.setAttribute('id', 'contentnode');
        pContent.innerHTML = str.toString();

        aOptions.setAttribute('href', '#!');
        aOptions.setAttribute('id', 'btnOke');
        aOptions.setAttribute('class', ' modal-action modal-close waves-effect waves-green btn-flat');
        aOptions.textContent = "Oke";
        $(aOptions).css({
          "background-color": "#4db6ac"
        });
        aOptions.addEventListener('click', removed);

        divContent.appendChild(htitle);
        divContent.appendChild(pContent);

        divFooter.appendChild(aOptions);

        divMain.appendChild(divContent);
        divMain.appendChild(divFooter);
        document.body.appendChild(divMain);
        $(divMain).openModal();
        $('#lean-overlay').click(function () {
          $('#modal1').remove();
        });
      }

        //return divMain;
    },
    validation: {
      inputText: function (data, minDataLength) {
        var patterns = /^[A-Za-z]{0,}([\w\W]*)?[A-Za-z]$/g,
          tmpData  = data.replace(/ /g, 'a');
        if (minDataLength !== undefined || minDataLength > 0) {
          return (patterns.test(data)) ? ((data.length >= minDataLength) ? true : false) : false;
        } else {
          return (patterns.test(data)) ? true : false;
            //return tmpData;
        }
      }
    }
  };
}(this));
