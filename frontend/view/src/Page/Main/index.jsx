import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import './main.css';

export const Main = () => {
    const [mensagem, setMensagem] = useState("");
    const [formData, setFormData] = useState({ nome: "", usuario: "", senha: "" });
    const [statusMsg, setStatusMsg] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const verificarSessao = async () => {
            try {
                const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/checkSession_controller.php", {
                    method: "GET",
                    credentials: "include",
                });
                const data = await response.json();

                if (data.status) {
                    setMensagem(data.usuario.nome_usuario);
                } else {
                    navigate("/login");
                }
            } catch (error) {
                navigate("/login");
            }
        };

        verificarSessao();
    }, [navigate]);

    const handleLogout = async () => {
        try {
            await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/logout_controller.php", {
                method: "POST",
                credentials: "include",
            });
            navigate("/login");
            window.location.reload();
        } catch (error) {
            console.error("Erro ao fazer logout:", error);
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData((prev) => ({ ...prev, [name]: value }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/createUser_controller.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                credentials: "include",
                body: JSON.stringify(formData),
            });

            const data = await response.json();

            if (data.status) {
                setStatusMsg("Usuário cadastrado com sucesso!");
                setFormData({ nome: "", usuario: "", senha: "" });
            } else {
                setStatusMsg(`Erro: ${data.message}`);
            }
        } catch (error) {
            console.error("Erro ao cadastrar usuário:", error);
            setStatusMsg("Erro interno ao cadastrar.");
        }
    };

    return (
        <div>
            <div className="msg">
                Bem vindo, <span className="name_user">{mensagem}</span>!
            </div>
            <form onSubmit={handleSubmit}>
                <h2>Cadastrar Usuário</h2>
                <div className="form-group">
                    <label>Nome</label>
                    <input
                        type="text"
                        name="nome"
                        className="form-control"
                        value={formData.nome}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div className="form-group">
                    <label>Usuário (email)</label>
                    <input
                        type="text"
                        name="usuario"
                        className="form-control"
                        value={formData.usuario}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div className="form-group">
                    <label>Senha</label>
                    <input
                        type="password"
                        name="senha"
                        className="form-control"
                        value={formData.senha}
                        onChange={handleChange}
                        required
                    />
                </div>
                <button type="submit">Cadastrar</button>
                <br /><br />
                {statusMsg && <p>{statusMsg}</p>}
            </form>
            <button onClick={handleLogout}>Sair</button>
        </div>
    );
};
