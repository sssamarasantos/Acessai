using Acessai.Domain.Models;

namespace Acessai.Domain.Interfaces.Services
{
    public interface IDisciplinaService
    {
        Task<IEnumerable<Disciplina>> BuscarAsync();
    }
}
