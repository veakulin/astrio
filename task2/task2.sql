select
	concat(w.first_name, " ", w.last_name) as worker_name,
	c.model as car_model,
	group_concat(ch.name) as children
from astrio.car as c
left join astrio.worker as w on c.user_id = w.id
left join astrio.child as ch on ch.user_id = w.id
group by w.id;
