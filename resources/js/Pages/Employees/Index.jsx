import { useForm, usePage } from "@inertiajs/react";
import { router } from "@inertiajs/react";
import { useState } from "react";

const Index = () => {
    const { users, filters } = usePage().props;
    const [role, setRole] = useState(filters?.role || "");
    const [speciality, setSpeciality] = useState(filters?.speciality || "");
    const { info } = usePage().props;
    const { data, post, errors } = useForm({
        name: "name",
        surname: "surname",
        password: "12345678",
        role: "employee",
        speciality: "asjasjaj",
        phone: "12345678",
        email: "asd@adsas.com",
        dni: "12345678",
    });
    function handleSearch() {
        if (role == "" && speciality == "") {
            router.get(
                route("employees.index"),
                {},
                { preserveState: true, replace: true }
            );
        } else {
            router.get(
                route("employees.index"),
                { role, speciality },
                { preserveState: true }
            );
        }
    }
    function handleSend() {
        post("/employees");
    }
    function handleId(id) {
        router.get(
            route("employees.show", id),
            {},
            {
                preserveState: true,
                preserveScroll: true,
                only: ["info"],
            }
        );
    }

    return (
        <>
            <div>Index</div>
            <input type="text" value={data.name} />
            {errors.name && <div>{errors.name}</div>}
            {errors.surname && <div>{errors.surname}</div>}
            {errors.password && <div>{errors.password}</div>}
            {errors.role && <div>{errors.role}</div>}
            {errors.speciality && <div>{errors.speciality}</div>}
            {errors.phone && <div>{errors.phone}</div>}
            {errors.email && <div>{errors.email}</div>}
            {errors.dni && <div>{errors.dni}</div>}
            {data.length > 0 && dat.map((ele) => <li>{ele.name}</li>)}
            <button onClick={handleSend}>send</button>
            <button onClick={handleId}>by id</button>
            <input
                type="text"
                value={role}
                onChange={(e) => setRole(e.target.value)}
            />
            <button onClick={handleSearch}>search</button>
            <input
                type="text"
                value={speciality}
                onChange={(e) => setSpeciality(e.target.value)}
            />
            <button onClick={handleSearch}>search</button>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>surname</th>
                        <th>role</th>
                        <th>speciality</th>
                    </tr>
                </thead>
                <tbody>
                    {users.data.map((data, index) => (
                        <tr key={data.id}>
                            <td>{index + 1}</td>
                            <td>{data.name}</td>
                            <td>{data.surname}</td>
                            <td>{data.role}</td>
                            <td>{data.speciality}</td>
                            <td>
                                <button onClick={() => handleId(data.id)}>
                                    show
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
            {info && <div>{info?.dni}</div>}
        </>
    );
};
export default Index;
