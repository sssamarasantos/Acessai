using Acessai.Domain.Models;

namespace Acessai.Domain.Interfaces.Repository
{
    public interface IAlunoRepository
    {
        Task<Aluno> GetAlunoByEmailAsync(string email);
        Task<object> PostAlunoAsync(Aluno aluno);
    }
}
