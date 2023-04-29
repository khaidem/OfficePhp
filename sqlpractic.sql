SELECT employee_project.employee_id, employees.employee_name, employee_project.project_name
FROM employee_project
LEFT JOIN employees
ON employees.id=employee_project.employee_id
ORDER BY employees.employee_name;