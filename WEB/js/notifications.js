
let span_notif = document.getElementById('counter_notification');

let messages = document.getElementById('messages');
let nb_msg = document.getElementsByClassName('content-message').length;
let content_message = document.getElementsByClassName('content-message');

let counter_notif = nb_msg;
span_notif.innerHTML = counter_notif;




function counter_decrement()
{

	counter_notif--;


	let notification = document.getElementById('counter_notification');

	notification.innerHTML = counter_notif;
	

	let test = document.getElementsByName('test');

	test[2].parentNode.removeChild(test[2]);
	

}

function counter_increment()
{

	counter_notif++;
	let notification = document.getElementById('counter_notification');

	notification.innerHTML = counter_notif;

}


