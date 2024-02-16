using Acessai.Domain.Dtos;
using Acessai.Domain.Models;

namespace Acessai.Domain.Interfaces.Services
{
    public interface IAlunoService
    {
        Task<Aluno> BuscarPorEmailAsync(string email);
        Task<bool> CadastrarAsync(AlunoRequest request);
        Task<bool> LoginAsync(string email, string senha);
        Task<bool> AtualizarAsync(long id, AlunoRequest request);
    }
}
