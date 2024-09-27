
var format_speedtest_byte_rate = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    if (colvar > 0){
        col.html('<span title="'+ fileSize(( parseFloat(colvar)/ 8), 2)+'ytes/s' + '" </span>' + fileSize_bits(parseFloat(colvar), 2)+'ps')
    } else {
        col.text("")
    }
}

var format_speedtest_byte_size = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    if (colvar > 0){
        col.text(fileSize(parseFloat(colvar), 2))
    } else {
        col.text("")
    }
}

// Filesize formatter (uses 1000 as base)
function fileSize_bits(size, decimals){
    // Check if number
    if(!isNaN(parseFloat(size)) && isFinite(size)){
        if(size == 0){ return '0 B'}
        if(decimals == undefined){decimals = 0};
        var i = Math.floor( Math.log(size) / Math.log(1000) );
        return ( size / Math.pow(1000, i) ).toFixed(decimals) * 1 + ' ' + ['', 'K', 'M', 'G', 'T', 'P', 'E'][i] + 'b';
    }
}