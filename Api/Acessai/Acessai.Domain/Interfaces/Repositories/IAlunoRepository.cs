using Acessai.Domain.Models;

namespace Acessai.Domain.Interfaces.Repository
{
    public interface IAlunoRepository
    {
        Task<Aluno> GetAlunoByIdAsync(long id);
    }
}
