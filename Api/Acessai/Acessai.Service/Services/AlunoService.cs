using Acessai.Domain.Dtos;
using Acessai.Domain.Interfaces.Repository;
using Acessai.Domain.Interfaces.Services;
using Acessai.Domain.Models;
using AutoMapper;

namespace Acessai.Service
{
    public class AlunoService : IAlunoService
    {
        private readonly IAlunoRepository _alunoRepository;
        private readonly IMapper _mapper;

        public AlunoService(IAlunoRepository alunoRepository, IMapper mapper)
        {
            _alunoRepository = alunoRepository;
            _mapper = mapper;
        }

        public async Task<Aluno> GetAlunoByEmailAsync(string email)
        {
            return await _alunoRepository.GetAlunoByEmailAsync(email);
        }

        public async Task<bool> PostAlunoAsync(AlunoRequest request)
        {
            var aluno = _mapper.Map<Aluno>(request);

            var response = await _alunoRepository.PostAlunoAsync(aluno);
            return (int)response > 0;
        }
    }
}
