// JavaScript Document

function date ( format, timestamp ) {
    // Format a local date/time  
    // 
    // version: 903.1614
    // discuss at: http://phpjs.org/functions/date
    // +   original by: Carlos R. L. Rodrigues (http://www.jsfromhell.com)
    // +      parts by: Peter-Paul Koch (http://www.quirksmode.org/js/beat.html)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: MeEtc (http://yass.meetcweb.com)
    // +   improved by: Brad Touesnard
    // +   improved by: Tim Wiel
    // +   improved by: Bryan Elliott
    // +   improved by: Brett Zamir
    // +   improved by: David Randall
    // +      input by: Brett Zamir
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Brett Zamir
    // -    depends on: timezone_abbreviations_list()
    // *     example 1: date('H:m:s \\m \\i\\s \\m\\o\\n\\t\\h', 1062402400);
    // *     returns 1: '09:09:40 m is month'
    // *     example 2: date('F j, Y, g:i a', 1062462400);
    // *     returns 2: 'September 2, 2003, 2:26 am'
    // *     example 3: date('Y W o', 1062462400);
    // *     returns 3: '2003 36 2003'
    // *     example 4: x = date('Y m d', (new Date()).getTime()/1000); // 2009 01 09
    // *     example 4: (x+'').length == 10
    // *     returns 4: true
    var a, tal=[], jsdate=(
        (typeof(timestamp) == 'undefined') ? new Date() : // Not provided
        (typeof(timestamp) == 'number') ? new Date(timestamp*1000) : // UNIX timestamp
        new Date(timestamp) // Javascript Date()
    );
    var pad = function(n, c){
        if( (n = n + "").length < c ) {
            return new Array(++c - n.length).join("0") + n;
        } else {
            return n;
        }
    };
    var ret = '';
    var txt_weekdays = ["Sunday","Monday","Tuesday","Wednesday",
        "Thursday","Friday","Saturday"];
    var txt_ordin = {1:"st",2:"nd",3:"rd",21:"st",22:"nd",23:"rd",31:"st"};
    var txt_months =  ["", "January", "February", "March", "April",
        "May", "June", "July", "August", "September", "October", "November",
        "December"];

    var f = {
        // Day
            d: function(){
                return pad(f.j(), 2);
            },
            D: function(){
                var t = f.l();
                return t.substr(0,3);
            },
            j: function(){
                return jsdate.getDate();
            },
            l: function(){
                return txt_weekdays[f.w()];
            },
            N: function(){
                return f.w() + 1;
            },
            S: function(){
                return txt_ordin[f.j()] ? txt_ordin[f.j()] : 'th';
            },
            w: function(){
                return jsdate.getDay();
            },
            z: function(){
                return (jsdate - new Date(jsdate.getFullYear() + "/1/1")) / 864e5 >> 0;
            },

        // Week
            W: function(){
                var a = f.z(), b = 364 + f.L() - a;
                var nd2, nd = (new Date(jsdate.getFullYear() + "/1/1").getDay() || 7) - 1;

                if(b <= 2 && ((jsdate.getDay() || 7) - 1) <= 2 - b){
                    return 1;
                } else{

                    if(a <= 2 && nd >= 4 && a >= (6 - nd)){
                        nd2 = new Date(jsdate.getFullYear() - 1 + "/12/31");
                        return date("W", Math.round(nd2.getTime()/1000));
                    } else{
                        return (1 + (nd <= 3 ? ((a + nd) / 7) : (a - (7 - nd)) / 7) >> 0);
                    }
                }
            },

        // Month
            F: function(){
                return txt_months[f.n()];
            },
            m: function(){
                return pad(f.n(), 2);
            },
            M: function(){
                var t;
                t = f.F(); return t.substr(0,3);
            },
            n: function(){
                return jsdate.getMonth() + 1;
            },
            t: function(){
                var n;
                if( (n = jsdate.getMonth() + 1) == 2 ){
                    return 28 + f.L();
                } else{
                    if( n & 1 && n < 8 || !(n & 1) && n > 7 ){
                        return 31;
                    } else{
                        return 30;
                    }
                }
            },

        // Year
            L: function(){
                var y = f.Y();
                return (!(y & 3) && (y % 1e2 || !(y % 4e2))) ? 1 : 0;
            },
            o: function(){
                if (f.n() === 12 && f.W() === 1) {
                    return jsdate.getFullYear()+1;
                }
                if (f.n() === 1 && f.W() >= 52) {
                    return jsdate.getFullYear()-1;
                }
                return jsdate.getFullYear();
            },
            Y: function(){
                return jsdate.getFullYear();
            },
            y: function(){
                return (jsdate.getFullYear() + "").slice(2);
            },

        // Time
            a: function(){
                return jsdate.getHours() > 11 ? "pm" : "am";
            },
            A: function(){
                return f.a().toUpperCase();
            },
            B: function(){
                // peter paul koch:
                var off = (jsdate.getTimezoneOffset() + 60)*60;
                var theSeconds = (jsdate.getHours() * 3600) +
                                 (jsdate.getMinutes() * 60) +
                                  jsdate.getSeconds() + off;
                var beat = Math.floor(theSeconds/86.4);
                if (beat > 1000) beat -= 1000;
                if (beat < 0) beat += 1000;
                if ((String(beat)).length == 1) beat = "00"+beat;
                if ((String(beat)).length == 2) beat = "0"+beat;
                return beat;
            },
            g: function(){
                return jsdate.getHours() % 12 || 12;
            },
            G: function(){
                return jsdate.getHours();
            },
            h: function(){
                return pad(f.g(), 2);
            },
            H: function(){
                return pad(jsdate.getHours(), 2);
            },
            i: function(){
                return pad(jsdate.getMinutes(), 2);
            },
            s: function(){
                return pad(jsdate.getSeconds(), 2);
            },
            u: function(){
                return pad(jsdate.getMilliseconds()*1000, 6);
            },

        // Timezone
            e: function () {
                var abbr='', i=0;
                if (window.php_js && window.php_js.default_timezone) {
                    return window.php_js.default_timezone;
                }
                if (!tal.length) {
                    tal = timezone_abbreviations_list();
                }
                for (abbr in tal) {
                    for (i=0; i < tal[abbr].length; i++) {
                        if (tal[abbr][i].offset === -jsdate.getTimezoneOffset()*60) {
                            return tal[abbr][i].timezone_id;
                        }
                    }
                }
                return 'UTC';
            },
            I: function(){
                var DST = (new Date(jsdate.getFullYear(),6,1,0,0,0));
                DST = DST.getHours()-DST.getUTCHours();
                var ref = jsdate.getHours()-jsdate.getUTCHours();
                return ref != DST ? 1 : 0;
            },
            O: function(){
               var t = pad(Math.abs(jsdate.getTimezoneOffset()/60*100), 4);
               if (jsdate.getTimezoneOffset() > 0) t = "-" + t; else t = "+" + t;
               return t;
            },
            P: function(){
                var O = f.O();
                return (O.substr(0, 3) + ":" + O.substr(3, 2));
            },
            T: function () {
                var abbr='', i=0;
                if (!tal.length) {
                    tal = timezone_abbreviations_list();
                }
                if (window.php_js && window.php_js.default_timezone) {
                    for (abbr in tal) {
                        for (i=0; i < tal[abbr].length; i++) {
                            if (tal[abbr][i].timezone_id === window.php_js.default_timezone) {
                                return abbr.toUpperCase();
                            }
                        }
                    }
                }
                for (abbr in tal) {
                    for (i=0; i < tal[abbr].length; i++) {
                        if (tal[abbr][i].offset === -jsdate.getTimezoneOffset()*60) {
                            return abbr.toUpperCase();
                        }
                    }
                }
                return 'UTC';
            },
            Z: function(){
               var t = -jsdate.getTimezoneOffset()*60;
               return t;
            },

        // Full Date/Time
            c: function(){
                return f.Y() + "-" + f.m() + "-" + f.d() + "T" + f.h() + ":" + f.i() + ":" + f.s() + f.P();
            },
            r: function(){
                return f.D()+', '+f.d()+' '+f.M()+' '+f.Y()+' '+f.H()+':'+f.i()+':'+f.s()+' '+f.O();
            },
            U: function(){
                return Math.round(jsdate.getTime()/1000);
            }
    };

    return format.replace(/[\\]?([a-zA-Z])/g, function(t, s){
        if( t!=s ){
            // escaped
            ret = s;
        } else if( f[s] ){
            // a date function exists
            ret = f[s]();
        } else{
            // nothing special
            ret = s;
        }

        return ret;
    });
}

function showPrice( number ){
	return "$ " + number_format( number, 2, ",", ".");
}

function number_format( number, decimals, dec_point, thousands_sep ) {
    // Formats a number with grouped thousands  
    // 
    // version: 902.1517
    // discuss at: http://phpjs.org/functions/number_format
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://getsprink.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +     bugfix by: Howard Yeend
    // +    revised by: Luke Smith (http://lucassmith.name)
    // +     bugfix by: Diogo Resende
    // +     bugfix by: Rival
    // %        note 1: For 1000.55 result with precision 1 in FF/Opera is 1,000.5, but in IE is 1,000.6
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    var n = number, prec = decimals;
    n = !isFinite(+n) ? 0 : +n;
    prec = !isFinite(+prec) ? 0 : Math.abs(prec);
    var sep = (typeof thousands_sep == "undefined") ? ',' : thousands_sep;
    var dec = (typeof dec_point == "undefined") ? '.' : dec_point;

    var s = (prec > 0) ? n.toFixed(prec) : Math.round(n).toFixed(prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

    var abs = Math.abs(n).toFixed(prec);
    var _, i;

    if (abs >= 1000) {
        _ = abs.split(/\D/);
        i = _[0].length % 3 || 3;

        _[0] = s.slice(0,i + (n < 0)) +
              _[0].slice(i).replace(/(\d{3})/g, sep+'$1');

        s = _.join(dec);
    } else {
        s = s.replace('.', dec);
    }

    return s;
}

