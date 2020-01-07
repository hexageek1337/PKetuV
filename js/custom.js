$(document).ready(function() {
	$('#date-menu').ready(function() {
		window.onload = date_time();

		function date_time()
		{
			date = new Date;
			year = date.getFullYear();
		        month = date.getMonth();
		        months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		        d = date.getDate();
		        day = date.getDay();
		        days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
		        h = date.getHours();
		        if(h<10)
		        {
		                h = "0"+h;
		        }
		        m = date.getMinutes();
		        if(m<10)
		        {
		                m = "0"+m;
		        }
		        s = date.getSeconds();
		        if(s<10)
		        {
		                s = "0"+s;
		        }
		        result = ''+days[day]+', '+d+' '+months[month]+' '+year+' '+h+':'+m+':'+s;
		        document.getElementById('date-menu').innerHTML = result;
		        setTimeout(date_time,'500');
		        return true;
		}
	});
});