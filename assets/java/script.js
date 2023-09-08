function ocultar(obj, es){
	let div = document.querySelector(obj);
	if(es==1){
		div.style.display = 'flex';
	}else{
		div.style.display = 'none';
	};
};

function Table(btn, divs, fun){
    ocultar(btn, fun);
    ocultar(divs[0], fun);

    let revfun = fun==0?1:0;
    ocultar(divs[1], revfun);
}