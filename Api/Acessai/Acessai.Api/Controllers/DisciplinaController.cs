using Acessai.Domain.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;

namespace Acessai.Api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class DisciplinaController : ControllerBase
    {
        private readonly IDisciplinaService _disciplinaService;

        public DisciplinaController(IDisciplinaService disciplinaService)
        {
            _disciplinaService = disciplinaService;
        }

        [HttpGet]
        public async Task<IActionResult> Buscar()
        {
            var response = await _disciplinaService.BuscarAsync();

            if (response == null || !response.Any())
            {
                return NoContent();
            }

            return Ok(response);
        }
    }
}
