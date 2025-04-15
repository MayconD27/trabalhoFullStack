import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

export const Main = () => {
    const [mensagem, setMensagem] = useState(""); // Exibir mensagens ao usuário
    const navigate = useNavigate();

    useEffect(() => {
        const verificarSessao = async () => {
            try {
                const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/checkSession.php", {
                    method: "GET",
                    credentials: "include", // Inclui cookies na requisição
                });

                const data = await response.json();

                if (data.status) {
                    // Sessão ativa, mostra o ID do usuário ou outras informações
                    console.log("Sessão ativa:", data.usuario); 
                    setMensagem(`Bem-vindo, usuário ID ${data.usuario}`); // Exibe a mensagem de boas-vindas
                } else {
                    console.log("Sessão inválida:", data.message);
                    navigate("/login"); // Redireciona para a tela de login se não estiver logado
                }
            } catch (error) {
                console.error("Erro ao verificar a sessão:", error);
                navigate("/login"); // Redireciona em caso de erro
            }
        };

        verificarSessao();
    }, [navigate]);

    const handleLogout = async () => {
        try {
            const response = await fetch("http://localhost/Projeto/trabalhoFullStack/backend/controller/logout.php", {
                method: "POST",
                credentials: "include", // Inclui cookies na requisição
            });

            const data = await response.json();

            if (data.status) {
                console.log(data.message); // Exibe mensagem de sucesso
                navigate("/login"); // Redireciona para a tela de login após o logout
            } else {
                console.error("Erro ao realizar logout.");
            }
        } catch (error) {
            console.error("Erro ao fazer logout:", error);
        }
    };

    return (
        <div>
            <h1>Página Principal</h1>
            {mensagem && <p>{mensagem}</p>} {/* Exibe mensagem de boas-vindas */}
            <button onClick={handleLogout}>Sair</button> {/* Botão de logout */}
        </div>
    );
};
