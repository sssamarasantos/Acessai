using Acessai.Domain.Interfaces.Repositories;
using Acessai.Domain.Interfaces.Services;
using Acessai.Domain.Models;

namespace Acessai.Service.Services
{
    public class DisciplinaService : IDisciplinaService 
    {
        private readonly IDisciplinaRepository _disciplinaRepository;

        public DisciplinaService(IDisciplinaRepository disciplinaRepository)
        {
            _disciplinaRepository = disciplinaRepository;
        }

        public async Task<IEnumerable<Disciplina>> BuscarAsync()
        {
            return await _disciplinaRepository.BuscarAsync();
        }
    }
}
