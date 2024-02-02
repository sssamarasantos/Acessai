using Acessai.Domain.Interfaces.Repository;
using Acessai.Domain.Interfaces.Services;
using Acessai.Domain.Models;

namespace Acessai.Service
{
    public class AlunoService : IAlunoService
    {
        private readonly IAlunoRepository _alunoRepository;

        public AlunoService(IAlunoRepository alunoRepository)
        {
            _alunoRepository = alunoRepository;
        }

        public async Task<Aluno> GetAlunoByIdAsync(long id)
        {
            return await _alunoRepository.GetAlunoByIdAsync(id);
        }
    }
}
