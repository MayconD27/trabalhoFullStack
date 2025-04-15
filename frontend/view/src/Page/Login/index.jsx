import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import "./login.css";

export const Login = () => {
    const [email, setEmail] = useState("");
    const [senha, setSenha] = useState("");
    const [mensagem, setMensagem] = useState("");
    const navigate = useNavigate();

    // Verificar se o usuário já está logado ao acessar a página de login
    useEffect(() => {
        const verificarSessao = async () => {
            try {
                const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/checkSession.php", {
                    method: "GET",
                    credentials: "include", // Inclui cookies na requisição
                });

                const data = await response.json();

                if (data.status) {
                    // Caso o usuário já esteja logado, redireciona para a página principal
                    navigate("/"); // Redireciona para a Main
                }
            } catch (error) {
                console.error("Erro ao verificar a sessão:", error);
            }
        };

        verificarSessao();
    }, [navigate]);

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/login.php", {
                method: "POST",
                body: JSON.stringify({ email, senha }),
            });

            const data = await response.json();

            if (data.status) {
                setMensagem(data.message);
                console.log("Login realizado com sucesso:", data.response);
                navigate("/"); // Redireciona para a página principal
            } else {
                setMensagem(data.message); // Exibe erro caso o login falhe
            }
        } catch (err) {
            console.error("Erro no login:", err);
            setMensagem("Erro ao efetuar o login. Tente novamente.");
        }
    };

    return (
        <div className="container">
            <div className="login-box">
                <h1>Login</h1>
                <form onSubmit={handleSubmit}>
                    <div>
                        <label htmlFor="email">E-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                        />
                    </div>
                    <div>
                        <label htmlFor="senha">Senha</label>
                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            value={senha}
                            onChange={(e) => setSenha(e.target.value)}
                            required
                        />
                    </div>
                    <button type="submit">Entrar</button>
                </form>
                {mensagem && <p>{mensagem}</p>}
            </div>
        </div>
    );
};
