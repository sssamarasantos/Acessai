using Acessai.Domain.Models;

namespace Acessai.Domain.Interfaces.Services
{
    public interface IAlunoService
    {
        Task<Aluno> GetAlunoByIdAsync(long id);
    }
}
