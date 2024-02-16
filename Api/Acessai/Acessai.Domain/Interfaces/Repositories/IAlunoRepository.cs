using Acessai.Domain.Models;

namespace Acessai.Domain.Interfaces.Repository
{
    public interface IAlunoRepository
    {
        Task<Aluno> BuscarPorEmailAsync(string email);
        Task<Aluno> BuscarPorIdAsync(long id);
        Task<object> InserirAsync(Aluno aluno);
        Task<bool> LoginAsync(string email, string senha);
        Task<bool> AtualizarAsync(Aluno aluno);
    }
}
