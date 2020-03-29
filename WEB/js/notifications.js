
let span_notif = document.getElementById('counter_notification');

let messages = document.getElementById('messages');
let nb_msg = document.getElementsByClassName('content-message').length;
let content_message = document.getElementsByClassName('content-message');

let counter_notif = nb_msg;
span_notif.innerHTML = counter_notif;




function counter_decrement()
{

	if(counter_notif >= 0)
	{
		let notification = document.getElementById('counter_notification');

		notification.innerHTML = counter_notif;
 	
		counter_notif--;

		content_message.onclick = function() 
		{

			content_message.parentNode.removeChild(content_message.innerHTML);

		}

	}

}

function counter_increment()
{

	counter_notif++;
	let notification = document.getElementById('counter_notification');

	notification.innerHTML = counter_notif;

}