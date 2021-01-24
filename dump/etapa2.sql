use employees;


select 

b.dept_name, CONCAT( c.first_name, ' ', c.last_name ) AS nome, count(a.emp_no) as total

FROM

dept_emp a

INNER JOIN departments b

ON a.dept_no = b.dept_no

INNER JOIN employees c

ON a.emp_no = c.emp_no

group by(a.emp_no)

order by total desc

LIMIT 10