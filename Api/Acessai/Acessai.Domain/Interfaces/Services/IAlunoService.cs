using Acessai.Domain.Dtos;
using Acessai.Domain.Models;

namespace Acessai.Domain.Interfaces.Services
{
    public interface IAlunoService
    {
        Task<Aluno> GetAlunoByEmailAsync(string email);
        Task<bool> PostAlunoAsync(AlunoRequest request);
    }
}
