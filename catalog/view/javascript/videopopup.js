
    function popup(windowname,wid,hig) {
        blanket_size(windowname,hig);
        window_pos(windowname,wid);
        toggle('blanket');
        toggle(windowname);
    }
    function blanket_size(div_id,hig) {
        if (typeof window.innerWidth != 'undefined') {
                viewportheight = window.innerHeight;
        } else {
                viewportheight = document.documentElement.clientHeight;
        }
        if ((viewportheight > document.body.parentNode.scrollHeight) && (viewportheight > document.body.parentNode.clientHeight)) {
                blanket_height = viewportheight;
        } else {
                if (document.body.parentNode.clientHeight > document.body.parentNode.scrollHeight) {
                        blanket_height = document.body.parentNode.clientHeight;
                } else {
                        blanket_height = document.body.parentNode.scrollHeight;
                }
        }
        var blanket = document.getElementById('blanket');
        blanket.style.height = blanket_height + 'px';
        var playDiv = document.getElementById(div_id);
            if(document.documentElement.scrollTop > 0)
            {
                scrollTop = document.documentElement.scrollTop;
            }else{
                scrollTop = document.body.scrollTop;
            }
        playDiv.style.top =  $(window).height()/2 - (hig)/2 + scrollTop +'px';
    }
    function toggle(div_id) {
        var el = document.getElementById(div_id);
        if ( el.style.display == 'none' ) {	el.style.display = 'block'; 
        }
        else {el.style.display = 'none';}
    }
    function window_pos(div_id,wid) {
        if(typeof window.innerWidth != 'undefined') {
                viewportwidth = window.innerHeight;
        } else {
                viewportwidth = document.documentElement.clientHeight;
        }
        if ((viewportwidth > document.body.parentNode.scrollWidth) && (viewportwidth > document.body.parentNode.clientWidth)) {
                window_width = viewportwidth;
        } else {
                if (document.body.parentNode.clientWidth > document.body.parentNode.scrollWidth) {
                        window_width = document.body.parentNode.clientWidth;
                } else {
                        window_width = document.body.parentNode.scrollWidth;
                }
        }
        var playDiv = document.getElementById(div_id);
        window_width = window_width/2-wid/2;
        playDiv.style.left = window_width + 'px';
    
   }
    
    function playerTab(emb){
		var embed = 'hid'+emb;
		document.getElementById('playerTab').innerHTML = document.getElementById(embed).innerHTML;
	}
    function playerLeft(emb){
		var embed = 'left'+emb;
		document.getElementById('playerLeft').innerHTML = document.getElementById(embed).innerHTML;
	}
    function playerTop(emb){
		var embed = 'top'+emb;
		document.getElementById('playerTop').innerHTML = document.getElementById(embed).innerHTML;
	}
    function playerG(emb){
		var embed = 'g'+emb;
		document.getElementById('playerG').innerHTML = document.getElementById(embed).innerHTML;
	}