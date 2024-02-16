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

        public async Task<Aluno> BuscarPorEmailAsync(string email)
        {
            return await _alunoRepository.BuscarPorEmailAsync(email);
        }

        public async Task<bool> CadastrarAsync(AlunoRequest request)
        {
            var aluno = _mapper.Map<Aluno>(request);

            var response = await _alunoRepository.InserirAsync(aluno);
            return (decimal)response > 0;
        }

        public async Task<bool> LoginAsync(string email, string senha)
        {
            return await _alunoRepository.LoginAsync(email, senha);
        }

        public async Task<bool> AtualizarAsync(long id, AlunoRequest request)
        {
            var aluno = await _alunoRepository.BuscarPorIdAsync(id);

            aluno.Nome = request.Nome;
            aluno.Email = request.Email;
            aluno.Senha = request.Senha;
            aluno.Assistencia = request.Assistencia;

            return await _alunoRepository.AtualizarAsync(aluno);
        }
    }
}
